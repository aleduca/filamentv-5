<?php

namespace App\Livewire;

use Livewire\Attributes\Url;

trait HasFilterUsers
{
	#[Url()]
	public string $age = '';
	#[Url()]
	public string $gender = '';

	public function filter(string $operator, mixed $value, string $filterBy)
	{
		$item = $operator . ':' . $value;

		$items = $this->$filterBy === '' ? [] : explode(',', $this->$filterBy);

		$index = array_search($item, $items);

		if ($index !== false) {
			unset($items[$index]);
		} else {
			$items[] = $item;
		}

		$this->$filterBy = implode(',', $items);
	}

	public function applyFilters($query, array $filters)
	{
		foreach ($filters as $filterBy) {
			if ($this->$filterBy) {
				$query->where(function ($subQuery) use ($filterBy) {
					foreach (explode(',', $this->$filterBy) as $filter) {
						// <:18,>:30,=:male
						[$operator,$value] = explode(':', $filter);

						$subQuery->orWhere($filterBy, $operator, $value);
					}
				});
			}
		}

		return $query;
	}

	public function isFilterChecked(string $filter, string $filterBy)
	{
		return in_array($filter, explode(',', $this->$filterBy));
	}
}
