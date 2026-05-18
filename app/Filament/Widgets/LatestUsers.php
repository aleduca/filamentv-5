<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Override;

class LatestUsers extends TableWidget
{
	protected static bool $isDiscovered = false;
	protected static ?string $heading = 'Latest Users';
	// protected int | string | array $columnSpan = 'full';

	// #[Override]
	// protected function getTableHeading(): string|Htmlable|null
	// {
	// 	return 'Teste ';
	// }

	public function table(Table $table): Table
	{
		return $table
			->query(fn (): Builder => User::query()->latest()->limit(5))
			->columns([
				TextColumn::make('id')->label('ID'),
				TextColumn::make('name')->limit(10)
				->tooltip(fn ($record) => $record->name)
				->label('User Name'),
				TextColumn::make('roles.name')
				->label('Roles')
				->default('No Role')
				->color(
					fn ($state) => $state === 'No Role' ? 'gray' : 'success'
				)
				->badge(),
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
					//
				]),
			]);
	}
}
