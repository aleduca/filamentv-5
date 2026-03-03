<div>
  {{-- <livewire:dashboard.index /> --}}
  <div class="max-w-5xl mx-auto">
    <livewire:modal-user-save />
    <x-filters-users />
    <x-user-search />
    <div class="rounded-xl border border-slate-800 bg-slate-900 shadow-sm">
      <!-- Header -->
      <div class="flex items-center justify-between px-6 py-4 border-b border-slate-800">
        <div>
          <h2 class="text-lg font-semibold text-white">
            Usuários ({{ $this->users->total() }})
          </h2>
          <p class="text-sm text-slate-400">
            Listagem de usuários
          </p>
        </div>

        <button class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500 transition cursor-pointer focus:outline-none" wire:click="openCreateUser">
          <span wire:loading.remove wire:target="openCreateUser">Novo Usuário</span>
          <span wire:loading wire:taregt="openCreateUser">Abrindo...</span>
        </button>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-slate-800/50 text-slate-400">
            <tr>
              <th class="px-6 py-3 text-left font-medium cursor-pointer" wire:click="order('name')">
                <div class="flex items-center gap-2">
                  <span>Nome</span>
                  <x-dynamic-component :component="$this->iconOrder('name')" />
                </div>
              </th>
              <th class="px-6 py-3 text-left font-medium cursor-pointer" wire:click="order('email')">
                <div class="flex items-center gap-2">
                  <span>Email</span>
                  <x-dynamic-component :component="$this->iconOrder('email')" />
                </div>
              </th>
              <th class="px-6 py-3 text-left font-medium">Age</th>
              <th class="px-6 py-3 text-left font-medium">Gender</th>
              <th class="px-6 py-3 text-center font-medium cursor-pointer" wire:click="order('posts_count')">
                <div class="flex items-center gap-2">
                  <span>Posts</span>
                  <x-dynamic-component :component="$this->iconOrder('posts_count')" />
                </div>
              </th>
            </tr>
          </thead>

          <tbody class="divide-y divide-slate-800">

            <!-- Linha -->
            @forelse($this->users as $user)
            <livewire:user.index :$user :key="$user->id" />
            @empty
            <tr>
              <td class="px-6 py-4 text-slate-400">
                Nenhum usuário encontrado
              </td>
            </tr>
            @endforelse

            <!-- Repete -->
          </tbody>
        </table>

        <div class="flex items-center justify-center px-6 py-4 border-t border-slate-800 text-sm text-slate-400">
          <div class="flex items-center gap-2">
            {{ $this->users->links() }}
          </div>
        </div>

      </div>

    </div>
  </div>


</div>
