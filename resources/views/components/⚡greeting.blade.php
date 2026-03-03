<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public function logout()
    {
      Auth::logout();

      session()->regenerate();
    }
};
?>

<span class="text-xs px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400">
  @auth()
  Olá, {{ auth()->user()->name }} <button wire:click="logout" class="bg-red-600 text-white p-1 rounded cursor-pointer">
    <span wire:loading.remove wire:target="logout">Logout</span>
    <span wire:loading wire:target="logout">
      <x-loading />
    </span>
  </button>
  @else
  Olá, visitante <a href="{{ route('login.index') }}" class="bg-green-600 text-white p-1 rounded">Login</a>
  @endauth
</span>
