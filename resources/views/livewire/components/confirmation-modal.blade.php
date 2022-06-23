<div>
    @if($isOpen)
        <div
                x-data="{}"
                wire:ignore.self
                class="modal fade"
                id="confirmation-modal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="confirmationModalLabel"
                aria-hidden="true"
        >
            <div @click.away.window="$wire.closeConfirmation" class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        {{ $message }}
                    </div>
                    <div class="modal-footer bg-light">
                        <x-jet-secondary-button wire:click.prevent="close" type="button" wire:loading.attr="disabled">
                            {{ __('Nevermind') }}
                        </x-jet-secondary-button>

                        @if(strtolower($type) === 'delete')
                            <x-jet-danger-button wire:click.prevent="delete" wire:loading.attr="disabled" class="btn btn-default">
                                {{ __('Delete') }}
                            </x-jet-danger-button>
                        @endif
                        @if(strtolower($type) === 'active' || strtolower($type) === 'disable')
                            <x-jet.button.primary wire:click.prevent="enableDisable" wire:loading.attr="disabled">
                                {{ strtolower($type) === 'active' ?  __('Active') : __('Disable')}}
                            </x-jet.button.primary>
                        @endif
                        @if(strtolower($type) === 'approve' || strtolower($type) === 'reject')
                            <x-jet.button.primary wire:click.prevent="approveReject" wire:loading.attr="disabled">
                                {{ $type === 'approve' ?  __('Approve') : __('Reject')}}
                            </x-jet.button.primary>
                        @endif
                        @if(strtolower($type) === 'online' || strtolower($type) === 'offline')
                            <x-jet.button.primary wire:click.prevent="onlineOffline" wire:loading.attr="disabled">
                                {{ $type === 'online' ?  __('Online') : __('Offline')}}
                            </x-jet.button.primary>
                        @endif
                        @if(strtolower($type) === 'verify')
                            <x-jet.button.primary wire:click.prevent="verify" wire:loading.attr="disabled">
                                {{ __('Verify')}}
                            </x-jet.button.primary>
                        @endif
                    </div>
                </div>
            </div>

            <x-jet.loader target="delete"/>
            <x-jet.loader target="enableDisable"/>
            <x-jet.loader target="onlineOffline"/>
            <x-jet.loader target="approveReject"/>
            <x-jet.loader target="verify"/>
            <x-jet.loader target="submit"/>
        </div>
    @endif
</div>
