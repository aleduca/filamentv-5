<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Select::make('user_id')
					->relationship('user', 'name')
					->required(),
				Select::make('category_id')
				->relationship('category', 'name')
				->required(),
				TextInput::make('title')
					->required(),
				TextInput::make('slug')
					->required(),
				Textarea::make('content')
					->rows(10)
					->required()
					->columnSpanFull(),
				Toggle::make('published')
					->required(),
			]);
	}
}
