<?php

namespace App\Filament\Resources\Users\Tables\Actions;

use App\Filament\Infolists\Components\PercentPostsEntry;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;

class ViewUserAction
{
	public static function make($totalPosts = null)
	{
		if (!$totalPosts) {
			$totalPosts = Post::count();
		}

		return Action::make('View')
					->icon(Heroicon::Eye)
					->color(Color::hex('#FFFFFF'))
					->slideOver()
					->modalSubmitAction(false)
					->modalWidth(Width::ExtraLarge)
					->modalHeading(fn ($record) => $record->name)
					->schema([
						Section::make('Name and E-mail')
						->description('Name and user e-mail')
						->columns(2)
						->schema([
							TextEntry::make('name'),
							TextEntry::make('email'),
						]),
						Section::make('Age and Gender')
						->columns(3)
						->description('User age and gender')
						->schema([
							TextEntry::make('age'),
							TextEntry::make('gender')->badge()->formatStateUsing(fn ($state) => ucfirst($state))->label('Gender'),
							TextEntry::make('is_admin')->badge()->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')->label('Admin?')->color(fn ($state) => $state ? 'success' : 'danger'),
						]),

						Section::make('Posts')
						->description('Posts')
						->columns(2)
						->schema([
							TextEntry::make('posts_count')->label('Posts'),
							PercentPostsEntry::make('Posts')
							->posts($totalPosts),
						]),
					]);
	}
}
