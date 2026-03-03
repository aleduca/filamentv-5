<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Lazy] class extends Component
{
  #[Computed]
  public function sales(){
    return Number::currency(mt_rand(1000,5000), 'BRL', 'pt_BR');
  }

  #[On('refreshStats')]
  public function refresh()
  {
  }

};
?>

<div>
  @placeholder
  <x-dashboard.loading-card />
  @endplaceholder
  <div class="relative bg-slate-900 border border-slate-800 rounded-xl p-6 shadow-lg">

    <div class="absolute top-4 right-4">
      <x-refresh wire:click="$refresh" wire:target="$refresh" />
    </div>

    <p class="text-sm text-slate-400">
      Sales
    </p>

    <h2 class="text-3xl font-semibold text-white mt-2">
      {{ $this->sales }}
    </h2>

    <p class="text-xs text-emerald-400 mt-2">
      Sales of the month
    </p>

  </div>
</div>
