<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

      <x-filament::section>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xl font-bold">
                    {{ $totalPosts }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ __('my-posts.total') }}
                </div>
            </div>
            <x-heroicon-o-document-text class="w-10 h-10 text-orange-400" />
        </div>
      </x-filament::section>

      <x-filament::section>
          <div class="flex items-center justify-between">
              <div>
                  <div class="text-xl font-bold">
                      {{ $publishedPosts }}
                  </div>

                  <div class="text-sm text-gray-500">
                        {{ __('my-posts.published') }}
                  </div>
              </div>
              <x-heroicon-o-check-badge class="w-10 h-10 text-success-500" />
          </div>
      </x-filament::section>

      <x-filament::section>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xl font-bold">
                    {{ auth()->user()->name }}
                </div>
                <div class="text-sm text-gray-500">
                       {{ __('my-posts.logged') }}
                </div>
            </div>
            <x-heroicon-o-user class="w-10 h-10 text-primary-500" />
        </div>
      </x-filament::section>

    </div>

    <x-filament::section heading="Últimos Posts" description="Últimos posts cadastrados por mim" icon="heroicon-o-document-text">
        <div class="space-y-4">
            @forelse($posts as $post)
                <div class="border rounded-xl p-4">
                    <div class="font-bold">
                        {{ $post->title }}
                    </div>

                    <div class="text-sm text-gray-500">
                        {{ $post->created_at->format('d/m/Y') }}
                    </div>
                </div>
            @empty
                <div>
                    Nenhum post encontrado.
                </div>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-panels::page>
