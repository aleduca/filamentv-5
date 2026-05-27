<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Stats extends StatsOverviewWidget
{
	protected static bool $isDiscovered = false;
	protected ?string $pollingInterval = '50s';

	protected function getColumns(): int | array | null
	{
		return 2;
	}

	protected function getStats(): array
	{
		$lastClear = Cache::get('last_cache_clear');

		return [
			Stat::make(
				__('widget-stats.card-1'),
				User::count('users.id')
			)
			->icon(Heroicon::Users)
			->description(__('widget-stats.card-1-description')),

			Stat::make(
				__('widget-stats.card-2'),
				Post::count('posts.id')
			)
			->icon(Heroicon::DocumentChartBar)
			->description(__('widget-stats.card-2-description')),

			Stat::make(
				__('widget-stats.card-3'),
				Auth::user()->posts->where('published', true)->count()
			)
			->icon(Heroicon::DocumentCheck)
			->description(__('widget-stats.card-3-description')),

			Stat::make(
				__('widget-stats.card4'),
				Auth::user()->posts->count()
			)->icon(Heroicon::DocumentText)
			->description(__('widget-stats.card-4-description')),

			Stat::make(
				__('widget-stats.card-5'),
				$lastClear
					? Carbon::parse($lastClear)->format('d/m/Y H:i')
					: __('widget-stats.cache-never-clear')
			)
				->description(
					$lastClear
						? Carbon::parse($lastClear)->diffForHumans()
						: __('widget-stats.cache')
				)
				->descriptionIcon('heroicon-o-trash')
				->color('warning'),
		];
	}
}
