<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class PostsTableColumns
{
	public static function make()
	{
		return [
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
		];
	}
}
