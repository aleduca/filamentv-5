<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Users\Tables\Actions\EmailAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class UsersTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns(UsersTableColumns::make())->deferColumnManager(false)
			->filters(UsersTableFilters::make(), layout: FiltersLayout::AboveContent)->deferFilters(false)
			->recordActions([
				// ViewAction::make(),
				EditAction::make(),
				EmailAction::make(),
				DeleteAction::make()
				->authorize('delete')
				->authorizationNotification(function ($action) {
					$canDelete = $action->isAuthorized();

					(!$canDelete) ?
						$action->icon(Heroicon::XMark)->color('gray') :
						$action->icon(Heroicon::Trash)->color('red');

					return $action;
				}),
				// ->authorizationTooltip(function ($action) {
				// 	$canDelete = $action->isAuthorized();

				// 	if (!$canDelete) {
				// 		$action->icon(Heroicon::XMark)->color('gray');
				// 	}

				// 	return $action;
				// }),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			]);
	}
}
