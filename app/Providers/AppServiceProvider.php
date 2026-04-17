<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Enums\TextSize;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentView;
use Filament\Tables\Columns\TextColumn;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		FilamentAsset::register([
			Css::make('custom', resource_path('css/filament/custom.css')),
		]);

		TextColumn::configureUsing(function (TextColumn $column) {
			$column->size(TextSize::Medium);
		});

		FilamentColor::register([
			'brand' => '#1e084a',
			'red' => '#dc143c',
			'custom_color' => '#27DAF5',
		]);

		FilamentView::registerRenderHook(
			PanelsRenderHook::FOOTER,
			fn (): View => view('filament.footer'),
		);
	}
}
