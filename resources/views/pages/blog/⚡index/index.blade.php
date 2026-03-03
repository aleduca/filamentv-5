<div>
  <x-post-search />

  <h2 class="text-2xl font-bold mt-5">Posts({{ $this->posts->total() }})</h2>

  @forelse($this->posts as $post)
  <livewire:blog.post.index :$post :key="$post->id" />
  @empty
  <h3 class="text-xl italic">Nenhum post encontrado</h3>
  @endforelse

  <div class="flex items-center justify-center px-6 py-4 border-t text-sm text-slate-400">
    <div class="flex items-center gap-2">
      {{ $this->posts->links(data:['scrollTo' => false]) }}
    </div>
  </div>

</div>
