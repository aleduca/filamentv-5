<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
	public static function configure(Table $table): Table
	{
		return $table
			->columns(UsersTableColumns::make())->deferColumnManager(false)
			->filters([
				// Filter::make('is_admin')->toggle()->label('Admin?')->query(fn (Builder $query): Builder => $query->where('is_admin', true)),

				// TernaryFilter::make('is_admin')
				// ->label('Admin?')
				// ->trueLabel('Only admins')
				// ->falseLabel('Only users')
				// ->placeholder('Everyone'),

				// SelectFilter::make('is_admin')
				// 	->options([
				// 		true => 'Yes',
				// 		false => 'No',
				// 	]),

				// SelectFilter::make('gender')
				// 	->options([
				// 		'male' => 'Male',
				// 		'female' => 'Female',
				// 	]),

				QueryBuilder::make()
				->constraints([
					TextConstraint::make('name'),
					BooleanConstraint::make('is_admin')
					->label('Administrator'),
					SelectConstraint::make('gender')
					->label('Gender')
					->options([
						'male' => 'Masculino',
						'female' => 'Feminino',
					])
					->multiple(),
					DateConstraint::make('created_at'),
				]),
			], layout: FiltersLayout::AboveContent)->deferFilters(false)
			->recordActions([
				ViewAction::make(),
				EditAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			]);
	}
}
