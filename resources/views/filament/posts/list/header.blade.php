<div class="flex items-center justify-between">
  <h2 class="text-4xl font-bold">
    Posts({{ $this->getTableRecords()->total() }})
  </h2>
    <x-filament::actions :actions="$this->getHeaderActions()" />
</div>