<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('title')
					->limit(15)
					->searchable(),
				TextColumn::make('user.name')
					->label('Author')
					->searchable(),
				TextColumn::make('category.name')
					->label('Category')
					->numeric()
					->sortable(),
				IconColumn::make('published')
					->alignCenter()
					->boolean(),
			])
			->filters([
				//
			])
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
