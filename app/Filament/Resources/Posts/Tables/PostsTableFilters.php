<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Category;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;

class PostsTableFilters
{
	public static function make()
	{
		return [
			QueryBuilder::make()
					->constraints([
						TextConstraint::make('title'),
						TextConstraint::make('user.name'),
						SelectConstraint::make('Category')
						->relationship('category', 'id')
						->options(Category::orderBy('name', 'asc')->pluck('name', 'id')->toArray()),
						SelectConstraint::make('published')
						->options([
							0 => 'Not Published',
							1 => 'Published',
						]),
					]),
			// SelectFilter::make('Category')
			// ->relationship('category', 'name'),
		];
	}
}
