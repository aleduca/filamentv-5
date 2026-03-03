<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $title ?? 'Blog - Clube Full-Stack' }}</title>

  @vite('resources/css/app.css')
  @livewireStyles
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">

  <!-- Header -->
  <header class="border-b border-slate-200 bg-white">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

      <!-- Brand -->
      <div class="flex items-center gap-6">
        <span class="text-sm font-semibold tracking-wide text-slate-900">
          Livewire 4
        </span>

        <!-- Navigation -->
        <nav class="hidden sm:flex items-center gap-1">
          <a href="{{ route('home.index') }}" wire:navigate class="rounded-md px-3 py-2 text-sm text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition">
            Home
          </a>
          <a href="{{ route('blog.index') }}" wire:navigate class="rounded-md px-3 py-2 text-sm text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition">
            Blog
          </a>
        </nav>
      </div>

      <!-- Right actions -->
      <div class="flex items-center gap-2">
        <livewire:greeting />
      </div>
    </div>
  </header>

  <!-- Conteúdo -->
  <main class="max-w-6xl mx-auto px-6 py-10">
    <div class="rounded-xl bg-white border border-slate-200 shadow-sm p-6">
      {{ $slot }}
    </div>
  </main>

  <!-- Footer -->
  <footer class="border-t border-slate-200 bg-white">
    <div class="max-w-6xl mx-auto px-6 py-4 text-xs text-slate-500 text-center">
      Exemplo de layout genérico • Livewire 4
    </div>
  </footer>

  @livewireScripts
</body>
</html>
