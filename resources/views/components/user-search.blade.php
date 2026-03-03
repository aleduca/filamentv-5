<section class="bg-black border-b border-zinc-800">
  <form>
    <div class="max-w-4xl mx-auto px-4 py-6">
      <div class="flex flex-col gap-3">
        <label for="search" class="text-sm font-medium text-zinc-400">
          Buscar
        </label>

        <div class="flex gap-2">
          <!-- Campo de busca -->
          <div class="relative flex-1">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-zinc-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.6-5.4a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            <input id="search" wire:model.live.debounce.500ms="searched" type="text" placeholder="Digite para buscar..." class="w-full bg-zinc-900 text-zinc-100 placeholder-zinc-500
                               border border-zinc-700 rounded-lg
                               pl-10 pr-4 py-2.5
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                               transition" />
          </div>
        </div>

        <div wire:loading wire:target="searched">
          Aguarde...
        </div>

        <p class="text-xs text-zinc-500">
          Busque por nome ou email...
        </p>
      </div>
    </div>
  </form>
</section>
