<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Resources\Users\UserResource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class UserForm
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make('Name and E-mail')
				->description('Name and E-mail')
				->columns(2)
				->schema([

					TextInput::make('name')
						->live(onBlur:true)
						->required(),
					TextInput::make('email')
						->rule(function ($record) {
							return Rule::unique(UserResource::getModel(), 'email')->ignore($record?->id);
						})
						->belowContent(function (Get $get, $context) {
							if ($context === 'create') {
								$name = $get('name') ?? 'User';

								return "{$name} type your e-mail";
							}

							return 'Type your e-mail';
						})
						->label('Email address')
						->email()
						->required(),
				]),

				Section::make(function ($context) {
					if ($context === 'create') {
						return 'Password and Password Confirmation';
					}

					return 'Password';
				})
				->description('Password')
				->schema([
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
				]),

				Section::make('Age, Gender and Admin')
				->description('Age and Gender')
				->schema([
					TextInput::make('age')
									->required()
									->numeric(),
					Select::make('gender')
					->required()
					->options(['male' => 'Male', 'female' => 'Female']),
					// Toggle::make('is_admin')->label('Admin?'),
					Select::make('is_admin')
					->required()
					->formatStateUsing(function ($state, $context) {
						if ($context === 'edit') {
							return $state ? 1 : 0;
						}
					})
					->label('Admin?')
					->options([
						true => 'Yes',
						false => 'No',
					]),
				]),

				Section::make('Created and UpdatedAt')
				->description('Create and update')
				->columns(2)
				->schema(function ($context) {
					if ($context === 'create') {
						return [Text::make('Can not show date')->color('danger')];
					}

					return [
						TextEntry::make('updated_at')->dateTime('d/m/Y'),
						TextEntry::make('created_at')->dateTime('d/m/Y'),
					];
				}),
			]);
	}
}
