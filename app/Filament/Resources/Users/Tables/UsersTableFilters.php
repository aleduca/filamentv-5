<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;

class UsersTableFilters
{
	public static function make()
	{
		return [
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
		];
	}
}
