<?php

namespace App\Filament\Fields\Traits;

use Livewire\WithFileUploads;

trait TinyUploadImage
{
	use WithFileUploads;

	public $temporaryImage;

	public function uploadImage()
	{
		$path = $this->temporaryImage->store('images', 'public');

		return asset('storage/' . $path);
	}
}
