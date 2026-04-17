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
