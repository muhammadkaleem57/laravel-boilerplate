<div>
    @if($target)
        <div class="loader loader-default is-active" wire:loading.delay data-text wire:target="{{$target}}"></div>
    @endif

    <div class="loader loader-default is-active" id="requestLoader" data-text style="display: none"></div>
</div>
