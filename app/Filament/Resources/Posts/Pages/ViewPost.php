<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\View\View;

class ViewPost extends ViewRecord
{
	protected static string $resource = PostResource::class;

	public function getHeader(): ?View
	{
		return view('filament.posts.view.header');
	}

	protected function getHeaderActions(): array
	{
		return [
			EditAction::make()->url(fn () => route('filament.admin.resources.posts.edit', ['record' => $this->record])),
		];
	}
}
