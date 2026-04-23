<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreatePost extends CreateRecord
{
	protected static string $resource = PostResource::class;

	public function getTitle(): string
	{
		return 'Create new Post';
	}
}
