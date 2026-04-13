<?php

namespace App\Filament\Infolists\Components;

use App\Filament\Support\PostsPercentCalculation;
use Filament\Infolists\Components\Entry;

class PercentPostsEntry extends Entry
{
	use PostsPercentCalculation;

	protected string $view = 'filament.infolists.components.percent-posts-entry';
}
