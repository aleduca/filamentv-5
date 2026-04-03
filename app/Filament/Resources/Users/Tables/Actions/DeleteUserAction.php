<?php

namespace App\Filament\Resources\Users\Tables\Actions;

use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;

class DeleteUserAction
{
	public static function make()
	{
		return DeleteAction::make()
				->authorize('delete')
				->authorizationTooltip(function ($action) {
					$canDelete = $action->isAuthorized();

					if (!$canDelete) {
						$action->icon(Heroicon::XMark)->color('gray');
					}

					return $action;
				});
	}
}
