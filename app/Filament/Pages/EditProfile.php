<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Auth\Pages\EditProfile as PagesEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;

class EditProfile extends PagesEditProfile
{
	// protected string $view = 'filament.pages.edit-profile';

	public function getHeader(): ?View
	{
		return view('filament.profile.header');
	}

	public function getFormActions(): array
	{
		return [];
	}

	public function form(Schema $schema): Schema
	{
		return $schema
			->components([
				Section::make('Name, E-mail and Password')
				->description('Name, e-mail and password')
				->columns(2)
				->schema([
					Section::make('Name and E-mail')
					->description('Update name and e-mail')
					->schema([
						$this->getNameFormComponent(),
						$this->getEmailFormComponent(),
					]),

					Section::make('Password')
					->description('Update your password')
					->schema([
						$this->getPasswordFormComponent(),
						$this->getPasswordConfirmationFormComponent(),
						$this->getCurrentPasswordFormComponent(),
					]),
				])->footerActions([
					Action::make('save')
					->label('Save')
					->action(fn () => $this->save()),
				]),

				Section::make('avatar')
				->description('Upload new Avatar')
				->schema([
					FileUpload::make('Avatar')
					->disk('public')
					->directory('avatars')
					->imageEditor()
					->circleCropper()
					->maxSize(1024)
					->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg'])
					->avatar(),
				]),
			]);
	}
}
