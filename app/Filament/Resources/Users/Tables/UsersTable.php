<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('name')->sortable()->searchable(),
				TextColumn::make('email')->limit(10)->sortable()->searchable(),
				TextColumn::make('age')->sortable(),
				TextColumn::make('gender')
				->formatStateUsing(
					fn ($state) => match ($state) {
						'male' => 'Masculino',
						'female' => 'Feminino',
					}
				),
				TextColumn::make('posts_count')->label('Posts')->counts('posts')->icon(Heroicon::ClipboardDocumentList),
				TextColumn::make('is_admin')
				->label('Admin?')
				->badge()
				->color(fn ($state) => $state === 1 ? 'success' : 'red')
				->formatStateUsing(fn ($state) => match ($state) {
					1 => 'Yes',
					0 => 'No',
				}),
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
