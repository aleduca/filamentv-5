{{-- @php
    $postsCount = $record->posts_count ?? 0;

    $percent = $totalPosts > 0
        ? round(($postsCount / $totalPosts) * 100)
        : 0;

    $color = match (true) {
        $percent > 70 => 'bg-green-500',
        $percent > 30 => 'bg-yellow-500',
        default => 'bg-red-500',
    };
@endphp --}}

<div {{ $getExtraAttributeBag() }}>
      <div class="{{ $getColor() }} h-2 rounded" style="width: {{ $getPercent() }}%">{{$getPercent()}}% (de {{$getPosts()}})</div>
</div>
