@php
  $percent = $getPercent();
  $color = $getColor($percent)
@endphp
<div {{ $getExtraAttributeBag() }}>
      <div class="{{ $color }} h-2 rounded" style="width: {{ $percent }}%">{{$percent}}% (de {{$getPosts()}})</div>
</div>
