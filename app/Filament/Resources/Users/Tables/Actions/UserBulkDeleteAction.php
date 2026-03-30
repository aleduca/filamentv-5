<?php

namespace App\Filament\Resources\Users\Tables\Actions;

use App\Models\User;
use Filament\Actions\BulkAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;

class UserBulkDeleteAction
{
	public static function make()
	{
		return BulkAction::make('delete')
						->label('Delete Selected Users')
						->icon(Heroicon::Trash)
						->color('red')
						->requiresConfirmation()
						->authorizeIndividualRecords('bulkDelete')
						->failureNotificationTitle(function ($successCount, $totalCount) {
							if ($successCount) {
								return "{$successCount} of {$totalCount} users deleted";
							}

							return 'No users deleted';
						})
						->successNotificationTitle('Users deleted')
						->action(function (Collection $records) {
							$records->each(function (User $record) {
								$record->delete();
							});
						});
	}
}
