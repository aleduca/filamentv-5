<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Users\Tables\Actions\DeleteUserAction;
use App\Filament\Resources\Users\Tables\Actions\EditUserAction;
use App\Filament\Resources\Users\Tables\Actions\EmailAction;
use App\Filament\Resources\Users\Tables\Actions\UserBulkDeleteAction;
use App\Filament\Resources\Users\Tables\Actions\ViewUserAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ViewAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class UsersTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->recordUrl(
				fn ($record): string => route('filament.admin.resources.users.view', ['record' => $record]),
			)
			->columns(UsersTableColumns::make())->deferColumnManager(false)
			->filters(UsersTableFilters::make(), layout: FiltersLayout::AboveContent)->deferFilters(false)
			->recordActions([
				ViewUserAction::make(),
				// ViewAction::make(),
				EditUserAction::make(),
				// EmailAction::make(),
				DeleteUserAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					UserBulkDeleteAction::make(),
				]),
			]);
	}
}
