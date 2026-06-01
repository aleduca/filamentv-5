<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Schemas\UserInfolist;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Override;

class UserResource extends Resource
{
	protected static ?string $model = User::class;

	protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;

	protected static ?string $recordTitleAttribute = 'Users List';

	protected static ?string $navigationLabel = 'Usuários';

	protected static ?int $navigationSort = 1;

	protected static int $globalSearchResultsLimit = 5;

	protected static ?int $globalSearchSort = 1;

	// protected static ?string $modelLabel = 'Usuário';

	// protected static ?string $pluralModelLabel = 'Usuáriossss';

	#[Override]
	public static function getGloballySearchableAttributes(): array
	{
		return [
			'name',
			'email',
		];
	}

	#[Override]
	public static function getGlobalSearchResultDetails(Model $record): array
	{
		return [
			'name' => $record->name,
			'email' => $record->email,
		];
	}

	#[Override]
	public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
	{
		return $record->name;
	}

	#[Override]
	public static function getGlobalSearchResultActions(Model $record): array
	{
		return [
			Action::make('view')
			->icon(Heroicon::User)
				->url(static::getUrl('view', ['record' => $record])),
			Action::make('edit')
			->icon(Heroicon::PencilSquare)
				->url(static::getUrl('edit', ['record' => $record])),
		];
	}

	// public static function getModelLabel(): string
	// {
	// 	return 'Usuário';
	// }

	// public static function getPluralModelLabel(): string
	// {
	// 	return 'Usuáriosss';
	// }

	public static function form(Schema $schema): Schema
	{
		// Schema -> organização, hierarquia e comunicação
		// Usado em forms, actions, layouts e infolists
		return UserForm::configure($schema); // CREATE/UPDATE
	}

	public static function infolist(Schema $schema): Schema
	{
		return UserInfolist::configure($schema); // VIEW
	}

	public static function table(Table $table): Table
	{
		return UsersTable::configure($table); // READ
	}

	public static function getEloquentQuery(): Builder
	{
		return parent::getEloquentQuery()->withCount('posts');
	}

	public static function getRelations(): array
	{
		return [
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListUsers::route('/'),
			'create' => CreateUser::route('/create'),
			'view' => ViewUser::route('/{record}'),
			'edit' => EditUser::route('/{record}/edit'),
		];
	}
}
