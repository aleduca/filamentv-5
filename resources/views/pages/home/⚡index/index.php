<?php

use App\Livewire\HasFilterUsers;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

new class extends Component {
	use WithPagination;
	use HasFilterUsers;

	public $orderAscDesc = 'asc';
	public $orderColumn = 'name';

	#[Url(as:'q')]
	public string $searched = '';

	protected $listeners = [
		'user-created' => 'userCreated',
		'user-deleted' => 'userDeleted',
	];

	public function userDeleted()
	{
		if ($this->users->isEmpty()) {
			$this->resetPage();

			if (filled($this->searched)) {
				$this->reset('searched');
			}

			unset($this->users);
		}
	}

	public function userCreated()
	{
		$this->reset('searched');

		$this->resetPage();
	}

	public function updatingSearched()
	{
		$this->resetPage();
	}

	public function openCreateUser()
	{
		$this->dispatch('openSaveUser');
	}

	public function order(string $orderBy)
	{
		$this->orderAscDesc = ($this->orderColumn !== $orderBy) ? 'asc' : (($this->orderAscDesc === 'asc') ? 'desc' : 'asc');
		$this->orderColumn = $orderBy;
		$this->resetPage();
	}

	public function iconOrder(string $column)
	{
		return ($this->orderColumn === $column) ? 'icon-' . $this->orderAscDesc : 'icon-neutro';
	}

	#[Computed]
	public function users()
	{
		$query = User::where(function ($query) {
			$query->where('name', 'like', '%' . $this->searched . '%')
			->orWhere('email', 'like', '%' . $this->searched . '%');
		});

		$query = $this->applyFilters($query, ['age', 'gender']);

		return $query->orderBy($this->orderColumn, $this->orderAscDesc)
		->withCount('posts')
		->paginate(10);
	}
};
