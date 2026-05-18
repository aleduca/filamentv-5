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
			Stat::make('Todos os users', User::count('users.id'))
			->description('Todos os users do portal')
			->icon(Heroicon::Users),
			// ->descriptionColor('success'),

			Stat::make('Todos os posts', Post::count('posts.id'))
			->description('Todos os posts do portal')
			->icon(Heroicon::DocumentChartBar),

			Stat::make('Posts publicados', Auth::user()->posts->where('published', true)->count())
			->description('Todos os meus posts publicados')
			->icon(Heroicon::DocumentCheck),

			Stat::make('Posts criados', Auth::user()->posts->count())
			->description('Todos os meus posts que eu criei')
			->icon(Heroicon::DocumentText),

			Stat::make(
				'Última limpeza',
				$lastClear ?
				Carbon::parse($lastClear)->format('d/m/Y H:i') : 'Nunca'
			)
			->columnSpanFull()
			->description(
				$lastClear ?
				Carbon::parse($lastClear)->diffForHumans() : 'Cache nunca foi limpo'
			)
			->descriptionIcon(Heroicon::Trash)
			->color('warning'),
		];
	}
}
