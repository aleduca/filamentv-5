<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Infolists\Components\PercentPostsEntry;
use App\Models\Post;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;

class UserInfolist
{
	public static function configure(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make('Name and E-mail')
				->description('Name and e-mail')
				->columns(2)
				->schema([
					TextEntry::make('name')
				->label('Name')
				->copyable()
				->icon(Heroicon::ClipboardDocumentCheck)
				->iconPosition(IconPosition::After)
				->size(TextSize::Large),
					TextEntry::make('email')
						->copyable()
						->label('Email address')
						->size(TextSize::Large)
						->icon(Heroicon::ClipboardDocumentCheck)
					->iconPosition(IconPosition::After),
				]),

				Section::make('Created and UpdatedAt')
				->description('Date')
				->columns(2)
				->schema([
					TextEntry::make('created_at')
					->since()
					->label('CreatedAt')
					->size(TextSize::Large)
					->placeholder('-'),
					TextEntry::make('updated_at')
						->dateTime('d/m/Y')
						->label('UpdatedAt')
						->placeholder('-')
						->size(TextSize::Large),
				]),

				Section::make('Age ,Gender and Admin')
				->description('Age, gender and Admin')
				->columns(3)
				->schema([
					TextEntry::make('age')
					->numeric()
					->placeholder('-')
					->size(TextSize::Large),
					TextEntry::make('gender')
						->badge()
						->formatStateUsing(function ($state) {
							return ucfirst($state);
						})
						->placeholder('-')
						->color(function ($state) {
							return $state === 'female' ? Color::hex('#FFB6C1') : Color::hex('#0000FF');
						})
						->size(TextSize::Large),
					TextEntry::make('is_admin')
						->label('Admin?')
						->badge()
						->formatStateUsing(function ($state) {
							return $state ? 'Yes' : 'No';
						})
						->color(function ($state) {
							return $state ? 'success' : 'danger';
						})
						->size(TextSize::Large),
				]),

				Section::make('Posts')
				->description('Posts')
				->columns(2)
				->schema([
					TextEntry::make('posts_count')
					->label('Posts'),
					PercentPostsEntry::make('Posts')
							->posts(function () {
								return Post::count();
							})
							->extraAttributes([
								'class' => 'text-center',
							]),
				]),
			]);
	}
}
