<?php

use Livewire\Component;

new class extends Component
{
    public $text;
    public $data;
    public $subtext;
};
?>

<div>
  <div class="relative bg-slate-900 border border-slate-800 rounded-xl p-6 shadow-lg">

    <div class="absolute top-4 right-4">
      {{ $slot }}
    </div>

    <p class="text-sm text-slate-400">
      {{ $this->text }}
    </p>

    <h2 class="text-3xl font-semibold text-white mt-2">
      {{ $this->data }}
    </h2>

    <p class="text-xs text-emerald-400 mt-2">
      {{ $this->subtext }}
    </p>

  </div>
</div>
