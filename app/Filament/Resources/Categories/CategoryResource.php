<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Clusters\Blog\BlogCluster;
use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Pages\ViewCategory;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Schemas\CategoryInfolist;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Override;

class CategoryResource extends Resource
{
	protected static ?string $model = Category::class;

	protected static ?string $cluster = BlogCluster::class;

	protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog8Tooth;

	protected static ?string $recordTitleAttribute = 'Category';

	// protected static ?string $navigationLabel = 'Categorias';

	protected static ?int $navigationSort = 3;

	protected static int $globalSearchResultsLimit = 5;

	protected static ?int $globalSearchSort = 3;

	#[Override]
	public static function getNavigationLabel(): string
	{
		return __('sidebar.categories');
	}

	public static function getNavigationBadge(): ?string
	{
		return (string) Category::count('categories.id');
	}

	public static function getNavigationBadgeColor(): ?string
	{
		return 'warning';
	}

	#[Override]
	public static function getGloballySearchableAttributes(): array
	{
		return [
			'name',
		];
	}

	#[Override]
	public static function getGlobalSearchResultDetails(Model $record): array
	{
		return [
			'name' => $record->name,
		];
	}

	#[Override]
	public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
	{
		return $record->name;
	}

	#[Override]
	public static function getGlobalSearchResultActions(Model $record): array
	{
		return [
			Action::make('view')
			->icon(Heroicon::User)
				->url(static::getUrl('view', ['record' => $record])),
			Action::make('edit')
			->icon(Heroicon::PencilSquare)
				->url(static::getUrl('edit', ['record' => $record])),
		];
	}

	public static function form(Schema $schema): Schema
	{
		return CategoryForm::configure($schema);
	}

	public static function infolist(Schema $schema): Schema
	{
		return CategoryInfolist::configure($schema);
	}

	public static function table(Table $table): Table
	{
		return CategoriesTable::configure($table);
	}

	public static function getRelations(): array
	{
		return [
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListCategories::route('/'),
			'create' => CreateCategory::route('/create'),
			'view' => ViewCategory::route('/{record}'),
			'edit' => EditCategory::route('/{record}/edit'),
		];
	}
}
