<?php

namespace App\Filament\Tables\Columns;

use App\Filament\Support\PostsPercentCalculation;
use Filament\Tables\Columns\Column;

class PercentPostsColumn extends Column
{
	use PostsPercentCalculation;

	protected string $view = 'filament.tables.columns.percent-posts';
}
