<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Component;

new #[Lazy] class extends Component
{
  #[Computed]
  public function users(){
    return User::count();
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
      Users
    </p>

    <h2 class="text-3xl font-semibold text-white mt-2">
      {{ $this->users }}
    </h2>

    <p class="text-xs text-emerald-400 mt-2">
      Users Registered
    </p>

  </div>
</div>
