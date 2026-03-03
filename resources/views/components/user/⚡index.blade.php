<?php

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Computed;

new class extends Component
{
    public User $user;

    protected $listeners = [
      'user-updated-{user.id}' => '$refresh'
    ];
};
?>

<tr class="hover:bg-slate-800/40 transition">
  <td class="px-6 py-4 font-medium text-white">
    {{ $this->user->name }}
  </td>

  <td class="px-6 py-4 text-slate-300">
    {{ $this->user->email }}
  </td>

  <td class="px-6 py-4 text-slate-400">
    {{ $this->user->age }}
  </td>

  <td class="px-6 py-4 text-slate-400">
    {{ $this->user->gender }}
  </td>

  <td class="px-6 py-4 text-slate-400 text-center" wire:ignore>
    {{ $this->user->posts_count }}
  </td>
</tr>
