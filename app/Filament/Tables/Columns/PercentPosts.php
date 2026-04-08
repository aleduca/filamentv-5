<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\Column;

class PercentPosts extends Column
{
	protected string $view = 'filament.tables.columns.percent-posts';
	protected $posts;
	protected $percent;

	public function posts($totalPosts):Column
	{
		$this->posts = $totalPosts;

		return $this;
	}

	public function getPosts()
	{
		return $this->posts;
	}

	private function calculate()
	{
		$postsCount = $this->getRecord()->posts_count ?? 0;

		$this->percent = $this->posts > 0
		  ? round(($postsCount / $this->posts) * 100)
		  : 0;

		return $this->percent;
	}

	public function getPercent()
	{
		return $this->percent;
	}

	public function getColor()
	{
		$percent = $this->calculate();

		return match (true) {
			$percent > 70 => 'bg-green-500',
			$percent > 20 => 'bg-yellow-500',
			default => 'bg-red-500',
		};
	}

	// $postsCount = $record->posts_count ?? 0;

	//   $percent = $totalPosts > 0
	//       ? round(($postsCount / $totalPosts) * 100)
	//       : 0;

	//   $color = match (true) {
	//       $percent > 70 => 'bg-green-500',
	//       $percent > 30 => 'bg-yellow-500',
	//       default => 'bg-red-500',
	//   };
}
