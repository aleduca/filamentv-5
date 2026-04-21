<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Auth\Pages\EditProfile as PagesEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class EditProfile extends PagesEditProfile
{
	protected string $view = 'filament.pages.edit-profile';

	public ?array $avatar = [];

	public function getHeader(): ?View
	{
		return view('filament.profile.header', [
			'user' => $this->getUser(),
		]);
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
			]);
	}

	public function avatarForm(Schema $schema):Schema
	{
		return $schema->components([
			Section::make('Avatar')
				->description('Upload new Avatar')
				->schema([
					FileUpload::make('avatar')
					->imageEditor()
					->circleCropper()
					->avatar()
					->hiddenLabel()
					->extraAttributes([
						'class' => 'mx-auto',
					]),
				])->footerActions([
					Action::make('avatar')
					->label('Update Avatar')
					->color('danger')
					->action(fn () => $this->uploadAvatar()),
				]),
		]);
	}

	private function uploadAvatar()
	{
		if (empty($this->avatar)) {
			return;
		}

		$this->validate([
			'avatar.*' => 'image|mimes:jpeg,png,jpg|max:1024',
		]);

		$file = collect($this->avatar)->first();

		$path = $file->store('avatars', 'public');

		$user = $this->getUser();

		if ($user->avatar && $user->avatar->path) {
			$oldPath = str_replace('/storage/', '', $user->avatar->path);
			if (Storage::disk('public')->exists($oldPath)) {
				Storage::disk('public')->delete($oldPath);
			}
		}

		$avatar = $user->avatar;
		$avatar->path = '/storage/' . $path;
		$avatar->save();

		$this->avatarForm->fill(['avatar' => null]);

		Notification::make()
		->title('Avatar saved')
		->success()
		->send();

		// dd($this->avatar, $file);
	}
}
