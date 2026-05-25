<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class PublishedPostsChart extends ChartWidget
{
	// protected ?string $heading = 'Published Posts Chart';

	protected static bool $isDiscovered = false;

	#[Override]
	public function getHeading(): string|Htmlable|null
	{
		return 'Posts publicados de ' . now()->startOfWeek()->format('d/m')
		. ' até ' . now()->endOfWeek()->format('d/m');
	}

	protected function getData(): array
	{
		$data = [];
		$labels = [];

		foreach (range(6, 0) as $day) {
			// 6,5,4,3,2,1,0
			// 22/05/2026 - 16/05/2026
			// 22/05/2026 - 17/05/2026
			// 22/05/2026 - 18/05/2026
			$date = now()->subDays($day);

			$count = Post::query()
			->whereDate('created_at', '=', $date, 'and')->where('published', true)
			->count('posts.id');

			// seg(17) - 12
			$labels[] = $date->translatedFormat('D (d)') . ' - ' . $count;

			$data[] = $count;
		}

		return [
			'datasets' => [
				[
					'label' => 'Posts Publicados',
					'data' => $data,
					'backgroundColor' => [
						'#ef4444', // Seg
						'#f97316', // Ter
						'#eab308', // Qua
						'#22c55e', // Qui
						'#3b82f6', // Sex
						'#8b5cf6', // Sab
						'#ec4899', // Dom
					],
				],
			],
			'labels' => $labels,
		];
	}

	protected function getType(): string
	{
		return 'bar';
	}
}
