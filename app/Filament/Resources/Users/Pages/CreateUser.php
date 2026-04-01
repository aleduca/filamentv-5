<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
	protected static string $resource = UserResource::class;

	public function getTitle(): string
	{
		return 'Create new User';
	}

	public function getCreatedNotificationTitle(): ?string
	{
		return 'User created successfully';
	}

	protected function getRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}

	public function canCreateAnother(): bool
	{
		return false;
	}
}
