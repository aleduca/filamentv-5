<?php

namespace App\Filament\Resources\Users\Tables\Actions;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class CreateNewUserAction
{
	public static function make()
	{
		return CreateAction::make()
				->label('Create new User')
				->slideOver()
				->createAnother(false)
				->modalWidth('sm')
				->successNotificationTitle('User created successfully')
				// ->successRedirectUrl()
				->schema([
					TextInput::make('name')
						->label('Name')
						->required()
						->minLength(5)
						->maxLength(50),
					TextInput::make('email')
						->unique(table: UserResource::getModel(), column: 'email')
						->email()
						->required()
						->minLength(5)
						->maxLength(50),
					TextInput::make('age')
					->required()
					->minLength(1)
					->maxLength(3),
					Select::make('gender')
					->options([
						'male' => 'Male',
						'female' => 'Female',
					]),
					TextInput::make('password')
						->password()
						->confirmed()
						->required()
						->minLength(5)
						->maxLength(50),
					TextInput::make('password_confirmation')
						->password()
						->required()
						->minLength(5)
						->maxLength(50),
				]);
	}
}
