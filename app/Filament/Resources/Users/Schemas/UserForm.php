<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Resources\Users\UserResource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class UserForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				TextInput::make('name')
					->required(),
				TextInput::make('email')
				// meuemail@email.com.br
					// ->unique(table: UserResource::getModel(), column: 'email')
					->rule(function ($record) {
						return Rule::unique(UserResource::getModel(), 'email')->ignore($record?->id);
					})
					->label('Email address')
					->email()
					->required(),
				TextInput::make('password')
					->password()
					->dehydrated(function ($state) {
						return filled($state);
					})
					->minLength(3)
					->maxLength(15)
					->confirmed(function ($context) {
						return $context === 'create';
					})
					->required(function ($context) {
						return $context === 'create';
					}),
				TextInput::make('password_confirmation')
					->password()
					->visibleOn('create')
					->minLength(3)
					->maxLength(15)
					->required(),
				TextInput::make('age')
					->required()
					->numeric(),
				Select::make('gender')
				->required()
				->options(['male' => 'Male', 'female' => 'Female']),
				// Toggle::make('is_admin')->label('Admin?'),
				Select::make('is_admin')
				->required()
				->formatStateUsing(fn ($state) => $state ? 1 : 0)
				->label('Admin?')
				->options([
					'true' => 'Yes',
					'false' => 'No',
				]),
			]);
	}
}
