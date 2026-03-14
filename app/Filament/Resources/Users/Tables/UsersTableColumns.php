<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;

class UsersTableColumns
{
	public static function make()
	{
		return [
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
			->color(fn ($state) => $state ? 'success' : 'red')
			->formatStateUsing(fn ($state) => match ($state) {
				true => 'Yes',
				false => 'No',
			}),
			TextColumn::make('created_at')->label('Created')->dateTime('d/m/Y')->toggleable(isToggledHiddenByDefault:true)->alignCenter(),
			TextColumn::make('updated_at')->label('Updated')->dateTime('d/m/Y')->toggleable(isToggledHiddenByDefault:true),
		];
	}
}
