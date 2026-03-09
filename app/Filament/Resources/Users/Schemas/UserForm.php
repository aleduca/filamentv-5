<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				TextInput::make('name')
					->required(),
				TextInput::make('email')
					->label('Email address')
					->email()
					->required(),
				TextInput::make('password')
					->password()
					->required(),
				TextInput::make('age')
					->numeric(),
				Select::make('gender')
					->options(['male' => 'Male', 'female' => 'Female']),
				TextInput::make('is_admin')
					->required()
					->numeric()
					->default(0),
			]);
	}
}
