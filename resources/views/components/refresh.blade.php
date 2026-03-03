<button {{ $attributes->merge([
    'class' => 'text-slate-400 hover:text-white transition cursor-pointer'
]) }}>

  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" wire:loading.class="animate-spin">
    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-4.992M3.977 14.652H8.97v4.992M4.5 9a7.5 7.5 0 0112.728-5.303L21.015 8.5M19.5 15a7.5 7.5 0 01-12.728 5.303L2.985 15.5" />
  </svg>

</button>
