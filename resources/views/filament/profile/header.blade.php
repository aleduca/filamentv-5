<div class="flex justify-between items-center">
  <h2 class="text-4xl font-bold">{{ $this->getUser()->name }}</h2>
  <div>
    @if ($user->avatar->path)
        <x-filament::avatar
          src="{{ $user->avatar->path }}"
          alt="{{ $user->name }}"
          size="lg"
        />
    @endif
  </div>
</div>