<section class="bg-zinc-100 border-b border-zinc-200">
  <form wire:submit="search" action="" method="post">
    <div class="max-w-4xl mx-auto px-4 py-6">
      <div class="flex flex-col gap-3">
        <label for="search" class="text-sm font-medium text-zinc-700">
          Buscar
        </label>

        <div class="flex gap-2">
          <!-- Campo de busca -->
          <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.6-5.4a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            <input id="search" wire:model="searched" type="text" placeholder="Digite para buscar..." class="w-full bg-white text-zinc-900 placeholder-zinc-400
                     border border-zinc-300 rounded-lg
                     pl-10 pr-4 py-2.5
                     focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                     transition" />
          </div>

          <!-- Botão -->
          <button type="submit" wire:loading.remove class="inline-flex items-center gap-2
                   bg-indigo-600 hover:bg-indigo-500
                   text-white font-medium
                   px-4 py-2.5 rounded-lg
                   focus:outline-none focus:ring-2 focus:ring-indigo-500
                   transition cursor-pointer">
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.6-5.4a7 7 0 11-14 0 7 0 0114 0z" />
            </svg>

            Buscar
          </button>
        </div>

        <div wire:loading wire:target="search">Aguarde...</div>

        <p class="text-xs text-zinc-500">
          Busque pelo título do post.
        </p>
      </div>
    </div>
  </form>
</section>
