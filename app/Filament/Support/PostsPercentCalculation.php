<?php

namespace App\Filament\Support;

use Closure;

trait PostsPercentCalculation
{
	protected int|Closure $posts;

	public function posts(int|Closure $totalPosts)
	{
		$this->posts = $totalPosts;

		return $this;
	}

	public function getPosts()
	{
		return $this->evaluate($this->posts);
	}

	public function getPercent()
	{
		$postsCount = $this->getRecord()->posts_count ?? 0;
		$posts = $this->getPosts();

		return $posts > 0
		  ? round(($postsCount / $posts) * 100)
		  : 0;
	}


	public function getColor($percent)
	{
		return match (true) {
			$percent > 70 => 'bg-green-500',
			$percent > 20 => 'bg-yellow-500',
			default => 'bg-red-500',
		};
	}
}
