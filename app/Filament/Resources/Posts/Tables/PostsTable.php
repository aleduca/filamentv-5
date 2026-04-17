<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Filament\Resources\Posts\Tables\PostsTableColumns;
use App\Filament\Resources\Posts\Tables\PostsTableFilters;
use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class PostsTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns(PostsTableColumns::make())
			->filters(PostsTableFilters::make(), layout: FiltersLayout::AboveContent)->deferFilters(false)
			->recordActions([
				ViewAction::make(),
				EditAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			]);
	}
}
