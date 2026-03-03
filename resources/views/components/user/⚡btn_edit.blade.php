<?php

use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component
{
  #[Locked]
  public $id;

  public function edit(){
     $this->dispatch('openSaveUser',id:$this->id);
  }
};
?>
<button wire:click="edit" class="text-indigo-400 hover:text-indigo-300 cursor-pointer">
  <span wire:loading.remove wire:target="edit">Edit</span>
  <span wire:loading wire:target="edit">
    <x-loading />
  </span>
</button>
