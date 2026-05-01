<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Fields\Traits\TinyUploadImage;
use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
	use TinyUploadImage;

	protected static string $resource = PostResource::class;

	public function getTitle(): string
	{
		return 'Create new Post';
	}
}
