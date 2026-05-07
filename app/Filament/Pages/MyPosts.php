<?php

namespace App\Filament\Pages;

use App\Models\Post;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class MyPosts extends Page
{
	protected string $view = 'filament.pages.my-posts';

	protected ?string $heading = 'My Posts';

	protected ?string $subheading = 'Here I can see my posts details';

	protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencil;

	protected static ?int $navigationSort = 3;

	protected static ?string $navigationLabel = 'My Posts';

	public $posts;

	public $totalPosts;

	public $publishedPosts;

	public static function canAccess(): bool
	{
		return Auth::user()->canManageSettings();
	}

	protected function getHeaderActions(): array
	{
		return [
			Action::make('Go to Home')
				->color(Color::hex('#00c950'))
				->icon(Heroicon::Home)
				->url(route('filament.admin.pages.dashboard')),

			Action::make('Export')
				->color(Color::hex('#4f42a9'))
				->icon(Heroicon::DocumentDuplicate)
				->visible(Auth::user()->can('export', Post::class))
				->action(function () {
					dd('export');
				}),
		];
	}

	public function mount()
	{
		$user = Auth::user();

		$posts = Post::where('user_id', $user->id)
		->latest()
		->get();

		$this->totalPosts = $posts->count();

		$this->posts = $posts->take(5);

		$this->publishedPosts = $posts->where('published', true)->count();
	}
}
