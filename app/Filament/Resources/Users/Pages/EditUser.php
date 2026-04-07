<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\Tables\Actions\ViewUserAction;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
	protected static string $resource = UserResource::class;

	protected function getHeaderActions(): array
	{
		return [
			// ViewUserAction::make(),
			ViewAction::make(),
			DeleteAction::make(),
		];
	}

	public function getTitle(): string
	{
		return 'Edit ' . $this->record->name;
	}

	public function getSavedNotificationTitle(): ?string
	{
		return 'User updated successfully';
	}

	protected function getRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}
}
