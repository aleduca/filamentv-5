<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\Tables\Actions\DeleteUserAction;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
	protected static string $resource = UserResource::class;

	protected ?string $subheading = 'Clique no name e e-mail para copiar.';

	protected function getHeaderActions(): array
	{
		return [
			EditAction::make(),
			DeleteUserAction::make(),
		];
	}

	public function getTitle():string
	{
		return "View {$this->record->name}";
	}
}
