<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\QueryBuilder\Constraints\SelectConstraint;
use Filament\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\SelectFilter;
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
				QueryBuilder::make()
				->constraints([
					TextConstraint::make('User')
					->relationship('user', 'name'),
					SelectConstraint::make('published')
					->options([
						1 => 'Published',
						0 => 'Not Published',
					]),
					SelectConstraint::make('category_id')
					->label('Category')
					->options(Category::orderBy('name', 'asc')->pluck('name', 'id')->toArray()),
				]),
				// SelectFilter::make('Category')
				// ->relationship('category', 'name'),
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
