<?php

namespace App\Providers;

use BezhanSalleh\LanguageSwitch\Enums\Placement;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
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
		LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
			$switch->locales(['en', 'fr', 'ar', 'de', 'es', 'pt', 'ko', 'pt_BR'])
			->visible(outsidePanels:true)
			->outsidePanelPlacement(Placement::TopLeft)
			// ->outsidePanelRoutes([
			// 	'home',
			// ])
			->nativeLabel()
			->flags([
				'en' => asset('flags/us.svg'),
				'fr' => asset('flags/fr.svg'),
				'ar' => asset('flags/sa.svg'),
				'de' => asset('flags/de.svg'),
				'es' => asset('flags/es.svg'),
				'pt' => asset('flags/pt.svg'),
				'ko' => asset('flags/kr.svg'),
				'pt_BR' => asset('flags/br.svg'),
			]);
		});

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
