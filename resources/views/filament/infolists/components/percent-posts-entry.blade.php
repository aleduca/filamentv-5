
@php
  $percent = $getPercent();
  $color = $getColor($percent)
@endphp
<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
<div {{ $getExtraAttributeBag() }}>
        <div class="{{ $color }} h-4 rounded" style="width: {{ $percent }}%">{{$percent}}%</div>
</div>
</x-dynamic-component>
