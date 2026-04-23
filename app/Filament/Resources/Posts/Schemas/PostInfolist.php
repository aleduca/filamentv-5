<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostInfolist
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make('Author and Category')
				->description('Author and Category')
				->columns(2)
				->schema([
					TextEntry::make('user.name')
									->label('Author'),
					TextEntry::make('category.name')
					->label('Category'),
				]),

				Section::make('Title and Slug')
				->description('Title and Slug')
				->columns(2)
				->schema([
					TextEntry::make('title'),
					TextEntry::make('slug'),
				]),

				Section::make('Content')
				->description('Content')
				->columnSpanFull()
				->schema([
					TextEntry::make('content')->html()->columnSpanFull(),
				]),

				Section::make('Published and Date')
				->description('Published and Date')
				->columnSpanFull()
				->columns(3)
				->schema([
					IconEntry::make('published')
					->boolean(),
					TextEntry::make('created_at')
						->dateTime()
						->placeholder('-'),
					TextEntry::make('updated_at')
						->dateTime()
						->placeholder('-'),
				]),

			]);
	}
}
