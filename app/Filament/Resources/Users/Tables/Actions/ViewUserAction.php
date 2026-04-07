<?php

namespace App\Filament\Resources\Users\Tables\Actions;

use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;

class ViewUserAction
{
	public static function make()
	{
		return Action::make('View')
					->icon(Heroicon::Eye)
					->color(Color::hex('#FFFFFF'))
					->slideOver()
					->modalHeading(fn ($record) => $record->name)
					->schema([
						Section::make('Name and E-mail')
						->description('Name and user e-mail')
						->columns(2)
						->schema([
							TextEntry::make('name'),
							TextEntry::make('email'),
						]),
						Section::make('Age, Gender and Posts')
						->columns(2)
						->description('User age, gender and posts')
						->schema([
							TextEntry::make('age'),
							TextEntry::make('gender')->badge()->formatStateUsing(fn ($state) => ucfirst($state))->label('Gender'),
							TextEntry::make('is_admin')->badge()->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')->label('Admin?')->color(fn ($state) => $state ? 'success' : 'danger'),
							TextEntry::make('posts_count')->label('Posts'),
						]),
					]);
	}
}
