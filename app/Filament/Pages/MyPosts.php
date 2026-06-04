<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\Blog\BlogCluster;
use App\Filament\Widgets\LatestUsers;
use App\Filament\Widgets\Stats;
use App\Models\Post;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Override;

class MyPosts extends Page
{
	protected string $view = 'filament.pages.my-posts';

	protected static ?string $cluster = BlogCluster::class;

	protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencil;

	protected static ?int $navigationSort = 4;

	public $posts;

	public $totalPosts;

	public $publishedPosts;

	#[Override]
	public function getHeading(): string|Htmlable|null
	{
		return __('my-posts.heading');
	}

	#[Override]
	public function getSubheading(): string|Htmlable|null
	{
		return __('my-posts.subheading');
	}

	#[Override]
	public static function getNavigationLabel(): string
	{
		return __('sidebar.my-posts');
	}

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

		$posts = Post::where('user_id', '=', $user->id, 'and')
		->latest()
		->get();

		$this->totalPosts = $posts->count();

		$this->posts = $posts->take(5);

		$this->publishedPosts = $posts->where('published', true)->count();
	}
}
