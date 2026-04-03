<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
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
				TextEntry::make('email_verified_at')
					->dateTime('d/m/Y H:i:s')
					->label('E-mail verified')
					->size(TextSize::Large)
					->placeholder('-'),
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
			]);
	}
}
