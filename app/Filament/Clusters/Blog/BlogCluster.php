<?php

namespace App\Filament\Clusters\Blog;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use Override;
use UnitEnum;

class BlogCluster extends Cluster
{
	protected static string|BackedEnum|null $navigationIcon = Heroicon::PencilSquare;

	// protected static ?string $navigationLabel = 'Blog';

	// protected static ?string $clusterBreadcrumb = 'Conteúdo';

	// protected static bool $shouldRegisterSubNavigation = true;

	protected static ?int $navigationSort = 2;

	// protected static string | UnitEnum | null $navigationGroup = 'Conteúdo';

	protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

	#[Override]
	public static function getNavigationLabel(): string
	{
		return __('clusters.blog.navigationLabel');
	}

	#[Override]
	public static function getClusterBreadcrumb(): ?string
	{
		return __('clusters.blog.breadcrumb');
	}

	#[Override]
	public static function getNavigationGroup(): string|UnitEnum|null
	{
		return __('clusters.blog.navigationGroup');
	}
}
