<?php

namespace App\Filament\Resources\Users\Tables\Actions;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class EditUserAction
{
	public static function make()
	{
		return EditAction::make()
					->slideOver()
					->modalHeading(function ($record) {
						return "Edit {$record->name}";
					})
					->successNotificationTitle('Updated Successfully')
					->modalWidth('sm')
					->modalCancelActionLabel('Cancelar')
					->modalSubmitActionLabel('Salvar')
					->schema([
						TextInput::make('name')
							->label('Name')
							->required()
							->minLength(5)
							->maxLength(50),
						TextInput::make('email')
							->unique(table: UserResource::getModel(), column: 'email', ignoreRecord:true)
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
						Select::make('is_admin')
						->label('Admin?')
						->options([
							true => 'Yes',
							false => 'No',
						])->formatStateUsing(fn ($state) => $state ? 1 : 0),
						// Toggle::make('is_admin')->label('Admin?'),
						TextInput::make('password')
							->password()
							->dehydrated(fn ($state) => filled($state))
							->minLength(5)
							->maxLength(50),
					]);
	}
}
