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
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
	protected static ?string $model = User::class;

	protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;

	protected static ?string $recordTitleAttribute = 'Users List';

	protected static ?string $navigationLabel = 'Usuários';

	protected static ?int $navigationSort = 1;

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
