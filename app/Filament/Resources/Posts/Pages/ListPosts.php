<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\View\View;

class ListPosts extends ListRecords
{
	protected static string $resource = PostResource::class;

	public ?string $subheading = 'Meus posts';

	protected function getHeaderActions(): array
	{
		return [
			CreateAction::make(),
		];
	}

	public function getHeader(): ?View
	{
		return view('filament.posts.list.header');
	}
}
