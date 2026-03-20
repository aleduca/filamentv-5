<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;

class UsersTableColumns
{
	public static function make()
	{
		return [
			TextColumn::make('name')->sortable()->searchable(),
			TextColumn::make('email')->limit(10)->sortable()->searchable(),
			TextInputColumn::make('age')->sortable()->rules([
				'required', 'numeric',
			]),
			SelectColumn::make('gender')->options([
				'male' => 'Male',
				'female' => 'Female',
			]),
			TextColumn::make('posts_count')->label('Posts')->counts('posts')->icon(Heroicon::ClipboardDocumentList),
			ToggleColumn::make('is_admin'),
			TextColumn::make('created_at')->label('Created')->dateTime('d/m/Y')->toggleable(isToggledHiddenByDefault:true)->alignCenter(),
			TextColumn::make('updated_at')->label('Updated')->dateTime('d/m/Y')->toggleable(isToggledHiddenByDefault:true),
		];
	}
}
