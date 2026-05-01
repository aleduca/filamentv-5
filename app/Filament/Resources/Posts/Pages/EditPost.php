<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Fields\Traits\TinyUploadImage;
use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
	use TinyUploadImage;

	protected static string $resource = PostResource::class;

	protected function getHeaderActions(): array
	{
		return [
			ViewAction::make(),
			DeleteAction::make(),
		];
	}
}
