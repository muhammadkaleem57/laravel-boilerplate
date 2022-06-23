<div>
    @if($target)
        <div class="loader loader-default is-active" wire:loading.delay data-text wire:target="{{$target}}"></div>
    @endif
</div>
