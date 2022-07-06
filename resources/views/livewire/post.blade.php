<div>
    @if(isset($title))
        {{-- @foreach($title as $item)
        <p>{{ $item }}</p>
        @endforeach --}}
        <p>{{$title }}</p>
    @else
        <p>Nothing</p>
    @endif
    <?php $arr = array(); ?>
        <a wire:click="calculate('rad')">Set MY Tile</a>
</div>
