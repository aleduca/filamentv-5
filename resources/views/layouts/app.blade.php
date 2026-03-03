<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="/favicon.ico">
  <title>{{ $title ?? 'Livewire 4 na prática' }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
  <livewire:toast />
  <div class="flex h-screen">

    <aside class="w-64 border-r border-slate-800 bg-slate-900 p-6 hidden lg:block">
      <h2 class="text-lg font-semibold mb-6 text-white">
        Livewire 4
      </h2>

      <nav class="space-y-2 text-sm">
        <p class="text-slate-400 uppercase tracking-wide text-xs mb-2">
          Curso Livewire 4
        </p>

        <ul class="space-y-1">
          <li class="text-slate-300">
            <a href="{{ route('home.index') }}" wire:navigate>Home</a>
          </li>

          <li class="text-slate-300">
            <a href="{{ route('blog.index') }}" wire:navigate>Blog</a>
          </li>

          <li class="text-slate-300">
            <a href="{{ route('login.index') }}" wire:navigate>Login</a>
          </li>
        </ul>
      </nav>
    </aside>

    {{-- Main --}}
    <div class="flex-1 flex flex-col">

      {{-- Topbar --}}
      <header class="h-16 border-b border-slate-800 bg-slate-900 flex items-center px-6">
        <div class="flex-1">
          <h1 class="text-lg font-medium">
            Vídeo: {{ config('livewire.aula.title') }}
          </h1>
          <p class="text-xs text-slate-400">
            Livewire 4 • {{ config('livewire.aula.title') }}
          </p>
        </div>

        <livewire:greeting />
      </header>

      {{-- Conteúdo --}}
      <main class="flex-1 p-8 bg-slate-950 overflow-y-auto">

        {{-- Card principal --}}
        <div class="max-w-4xl mx-auto">
          {{-- Slot da aula --}}
          {{ $slot }}
        </div>

      </main>

      {{-- Footer --}}
      <footer class="h-10 border-t border-slate-800 bg-slate-900 flex items-center px-6 text-xs text-slate-400 text-center">
        Livewire 4 - {{ config('livewire.aula.title') }}
      </footer>

    </div>
  </div>

  @livewireScripts
</body>
</html>
