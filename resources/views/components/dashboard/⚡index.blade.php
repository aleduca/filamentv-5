<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;

new class extends Component
{
  public function eventListener(){
    dump('event listener');
  }
};
?>
<div>
  <x-refresh wire:click="$dispatch('refreshStats')" />
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
    <livewire:dashboard.sales />
    <livewire:dashboard.users />
  </div>
</div>
