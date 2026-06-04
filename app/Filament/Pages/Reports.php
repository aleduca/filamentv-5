<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\Employees\EmployeesCluster;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Override;

class Reports extends Page
{
	protected string $view = 'filament.pages.reports';

	protected static ?string $cluster = EmployeesCluster::class;

	protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentChartBar;

	protected static ?int $navigationSort = 5;

	#[Override]
	public static function getNavigationLabel(): string
	{
		return __('sidebar.reports');
	}
}
