<?php

namespace App\Http\Livewire\Components;

use App\Concerns\InteractsWithModal;
use Livewire\Component;

class EventListener extends Component
{
    use InteractsWithModal;

    protected $listeners = [
        'interact:with:open:model' => 'openModalListener'
    ];

    public function render()
    {
        return view('livewire.components.event-listener');
    }

    public function openModalListener(string $form, $id = null, ?string $modalSize = null)
    {
        $this->openModal($form, $id, $modalSize);
    }
}
