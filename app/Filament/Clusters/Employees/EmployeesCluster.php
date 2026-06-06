<?php

namespace App\Filament\Clusters\Employees;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use Override;
use UnitEnum;

class EmployeesCluster extends Cluster
{
	protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;

	// protected static ?string $navigationLabel = 'Employees';

	// protected static ?string $clusterBreadcrumb = 'Conteúdo';

	// protected static bool $shouldRegisterSubNavigation = true;

	protected static ?int $navigationSort = 1;

	// protected static string | UnitEnum | null $navigationGroup = 'Conteúdo';

	protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

	#[Override]
	public static function getNavigationLabel(): string
	{
		return __('clusters.employees.navigationLabel');
	}

	#[Override]
	public static function getClusterBreadcrumb(): ?string
	{
		return __('clusters.employees.breadcrumb');
	}

	#[Override]
	public static function getNavigationGroup(): string|UnitEnum|null
	{
		return __('clusters.employees.navigationGroup');
	}
}
