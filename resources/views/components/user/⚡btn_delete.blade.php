<?php

use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component
{
  #[Locked]
  public $id;

  public function delete()
  {
    sleep(1);
    throw new Exception('Error');
    // User::where('id', $this->id)->delete();
    // $this->dispatch('user-deleted')->to('pages::home.index');
    // $this->dispatch('toast',message:'User Deleted')->to('toast');
  }
};
?>

<button wire:click="delete" wire:confirm-sweet="Tem certeza que deseja deletar o user?" wire:confirm-sweet-title="Tem certeza?" class="text-rose-400 hover:text-rose-300 cursor-pointer">
  <span wire:loading.remove wire:target="delete">Delete</span>
  <span wire:loading wire:target="delete">
    <x-loading />
  </span>
</button>
