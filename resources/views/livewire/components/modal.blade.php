<div>
    @if($isOpen)
        <div
                x-data="{}"
                wire:ignore.self
                class="modal fade"
                id="form-modal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="formModalLabel"
                aria-hidden="true"
        >
            <div @click.away.window="$wire.close()" class="modal-dialog {{$modalSize ?? ''}}" role="document">
                <div class="modal-content">

                    <!-- Model Body -->
                    @livewire($form, compact('selectedItem', 'event'))

                </div>
            </div>
        </div>
    @endif
</div>
