<div class="flex items-center justify-between">
  <h2 class="text-4xl font-bold">
    {{ ucfirst($this->record->title) }}
  </h2>
  <div>
   <x-filament::actions :actions="$this->getHeaderActions()" />
  </div>
</div>