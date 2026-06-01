<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Pages\ViewPost;
use App\Filament\Resources\Posts\Schemas\PostForm;
use App\Filament\Resources\Posts\Schemas\PostInfolist;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Override;

class PostResource extends Resource
{
	protected static ?string $model = Post::class;

	protected static string|BackedEnum|null $navigationIcon = Heroicon::PencilSquare;

	protected static ?string $recordTitleAttribute = 'Post';

	protected static ?string $navigationLabel = 'Posts';

	protected static ?int $navigationSort = 2;

	protected static ?int $globalSearchSort = 2;

	// protected static bool $isGloballySearchable = false;

	protected static int $globalSearchResultsLimit = 5;

	#[Override]
	public static function getGloballySearchableAttributes(): array
	{
		return [
			'title',
			'user.name',
		];
	}

	#[Override]
	public static function getGlobalSearchEloquentQuery(): Builder
	{
		return parent::getGlobalSearchEloquentQuery()->with('user');
	}

	// #[Override]
	// public static function getGlobalSearchResultUrl(Model $record): ?string
	// {
	// 	return static::getUrl('edit', ['record' => $record]);
	// }

	#[Override]
	public static function getGlobalSearchResultActions(Model $record): array
	{
		return [
			Action::make('view')
						->icon(Heroicon::User)
							->url(static::getUrl('view', ['record' => $record])),
			Action::make('edit')
			->icon(Heroicon::PencilSquare)
				->url(static::getUrl('edit', ['record' => $record])),
		];
	}

	#[Override]
	public static function getGlobalSearchResultDetails(Model $record): array
	{
		return [
			'title' => $record->title,
			'content' => Str::limit($record->content, 30),
			'author' => $record->user->name,
		];
	}

	#[Override]
	public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
	{
		return Str::limit($record->title, 20);
	}

	public static function form(Schema $schema): Schema
	{
		return PostForm::configure($schema);
	}

	public static function infolist(Schema $schema): Schema
	{
		return PostInfolist::configure($schema);
	}

	public static function table(Table $table): Table
	{
		return PostsTable::configure($table);
	}

	public static function getEloquentQuery(): Builder
	{
		return parent::getEloquentQuery()->orderBy('id', 'desc');
	}

	public static function getRelations(): array
	{
		return [
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListPosts::route('/'),
			'create' => CreatePost::route('/create'),
			'view' => ViewPost::route('/{record}'),
			'edit' => EditPost::route('/{record}/edit'),
		];
	}
}
