<?php

use Livewire\Component;
use App\Models\Post;

new class extends Component
{
    public Post $post;
};
?>

<div class="max-w-4xl mx-auto mt-4 space-y-4">

  <!-- Post -->
  <article class="bg-white border border-slate-200 rounded-xl p-6 hover:border-slate-300 transition">

    <header class="mb-3">
      <h2 class="text-xl font-semibold text-slate-900 leading-tight">
        {{ $this->post->title }}
      </h2>
    </header>

    <p class="text-slate-600 text-sm leading-relaxed mb-4">
      {{ Str::limit($this->post->content, 200, '...') }}
    </p>

    <footer class="flex flex-wrap items-center justify-between text-xs text-slate-500 gap-3">

      <div class="flex flex-col gap-1">
        <span>
          Autor: <strong class="text-slate-700">{{ $this->post->user->name }}</strong>
        </span>

        <div class="flex items-center gap-4">
          <span>
            Publicado em:
            <strong class="text-emerald-600">{{ $this->post->created_at->format('d/m/Y H:i:s') }}</strong>
          </span>
        </div>
      </div>

      <a href="{{ route('blog.post.show',$this->post->slug) }}" wire:navigate class="text-indigo-600 hover:text-indigo-700 transition">
        Ler post →
      </a>

    </footer>

  </article>


</div>
