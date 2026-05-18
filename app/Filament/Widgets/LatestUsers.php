<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Override;

class LatestUsers extends TableWidget
{
	protected static bool $isDiscovered = false;
	// protected int | string | array $columnSpan = 'full';
	protected static ?string $heading = 'Latest Users';

	public function table(Table $table): Table
	{
		return $table
			->query(
				fn (): Builder => User::query()->latest()
			->with('roles')
			->limit(5)
			->withCount('posts')
			)
			->columns([

				TextColumn::make('id')
							->label('ID'),

				TextColumn::make('name')
				// ->searchable()
				->label('User Name')
				->tooltip(fn ($record) => $record->name)
				->limit(10),
				// ->sortable(),

				TextColumn::make('roles.name')
				->badge()
				->default('No role')
				->label('Role')
				->color(
					fn ($state) => $state === 'No role' ? 'gray' : 'success'
				),

				TextColumn::make('posts_count')
				->label('Posts')
				->badge(),
				// ->sortable(),
			])
			->paginated(false)
			// ->defaultPaginationPageOption(5)
			->filters([
				//
			])
			->headerActions([
				//
			])
			->recordActions([
				DeleteAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					// DeleteBulkAction::make(),
				]),
			]);
	}
}
