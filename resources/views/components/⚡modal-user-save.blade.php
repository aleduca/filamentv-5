<?php

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Models\User;

new class extends Component
{
    public User $user;
    public bool $open = false;
    public bool $isEdit = false;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    // protected $listeners = [
    //   'openCreateUser' => 'open'
    // ];

    private function canEdit($id)
    {
        $this->isEdit = true;
        $this->user = User::find($id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    #[On('openSaveUser')]
    public function open($id = null)
    {
      if($id) $this->canEdit($id);
      $this->open = true;
    }

    public function close()
    {
      $this->resetValidation();

      $this->reset('name','email','password','isEdit');

      $this->open = false;
    }

    // public function rules(){
    //   return [
    //     'name' => 'required',
    //     'email' => 'required|email|unique:users,email',
    //     'password' => 'required|min:3',
    //   ];
    // }

    public function create()
    {
      $validated = $this->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:3',
      ]);

      User::create($validated);

      $this->close();

      $this->dispatch('user-created')->to('pages::home.index');
      $this->dispatch('toast', message: 'User Created')->to('toast');
    }

    public function update()
    {
      $validated = $this->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,'.$this->user->id,
        'password' => 'nullable|min:3',
      ]);

      if(empty($validated['password'])){
        unset($validated['password']);
      }

      $this->user->update($validated);

      $this->close();

      $this->dispatch('user-updated-'.$this->user->id)->to('user.index');
      $this->dispatch('toast', message: 'User Updated')->to('toast');
    }
};
?>

<div>
  @if($this->open)
  <div x-data @keydown.escape.window="$wire.close()" class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- Backdrop -->
    <div @click="$wire.close()" class="absolute inset-0 bg-black/70"></div>

    <!-- Modal -->
    <div class="relative z-10 w-full max-w-lg rounded-xl
                   bg-zinc-900 text-zinc-100
                   p-6 shadow-2xl
                   border border-zinc-800">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-zinc-100">
          Adicionar usuário
        </h2>

        <button @click="$wire.close()" class="text-zinc-400 hover:text-zinc-200 transition cursor-pointer">
          ✕
        </button>
      </div>

      <!-- Conteúdo -->
      <div class="text-zinc-300">
        <form wire:submit="{{ $this->isEdit ? 'update' : 'create' }}" class="space-y-4">
          <!-- Nome -->
          <div>
            <label for="name" class="mb-1 block text-sm font-medium text-zinc-300">
              Nome
            </label>

            <input id="name" wire:model="name" type="text" placeholder="Nome completo" class="w-full rounded-lg
                   bg-zinc-800 text-zinc-100 placeholder-zinc-500
                   border border-zinc-700
                   px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            @error('name')
            <span class="text-red-600 italic text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="mb-1 block text-sm font-medium text-zinc-300">
              Email
            </label>

            <input id="email" wire:model="email" type="text" placeholder="email@exemplo.com" class="w-full rounded-lg
                   bg-zinc-800 text-zinc-100 placeholder-zinc-500
                   border border-zinc-700
                   px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            @error('email')
            <span class="text-red-600 italic text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Senha -->
          <div>
            <label for="password" class="mb-1 block text-sm font-medium text-zinc-300">
              Senha
            </label>

            <input id="password" wire:model="password" type="password" placeholder="••••••••" class="w-full rounded-lg
                   bg-zinc-800 text-zinc-100 placeholder-zinc-500
                   border border-zinc-700
                   px-3 py-2
                   focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            @error('password')
            <span class="text-red-600 italic text-sm">{{ $message }}</span>
            @enderror
          </div>

          <!-- Ações -->
          <div class="flex justify-end gap-2 pt-2">
            <button @click="$wire.close()" type="button" class="rounded-lg border border-zinc-700 px-4 py-2 text-sm text-zinc-300 hover:bg-zinc-800 transition cursor-pointer">
              Cancelar
            </button>

            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white
                   hover:bg-indigo-500 transition
                   disabled:opacity-60 cursor-pointer">
              <span wire:loading.remove wire:target="create">
                @if($this->isEdit)
                Atualizar
                @else
                Salvar
                @endif
              </span>
              <span wire:loading wire:target="create">Aguarde...</span>
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
  @endif
</div>
