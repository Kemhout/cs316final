<div>
    @if(isset($title))
        {{-- @foreach($title as $item)
        <p>{{ $item }}</p>
        @endforeach --}}
        <p>{{$title }}</p>
    @else
        <p>Nothing</p>
    @endif
        <a wire:click="boot('rad')">Set MY Tile</a>
</div>
