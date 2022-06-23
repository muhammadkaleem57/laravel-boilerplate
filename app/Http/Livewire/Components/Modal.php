<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Modal extends Component
{
    public bool $isOpen = false;
    public string $form = '';
    public string $modalSize = '';
    public ?string $event = '';
    public $selectedItem;

    protected $listeners = ['show::FormModal' => 'open', 'close::FormModal' => 'close'];

    public function open(string $form, $id = null, ?string $event = '', ?string $modalSize = null)
    {
        $this->isOpen = true;
        $this->form = $form;
        $this->event = $event;
        $this->selectedItem = $id;

        if ($modalSize)
            $this->modalSize = $modalSize;

        $this->dispatchBrowserEvent('show-form-modal');
    }

    public function close()
    {
        $this->reset();

        $this->dispatchBrowserEvent('close-form-modal');
        $this->dispatchBrowserEvent('close-modal-backdrop');
    }

    public function render()
    {
        return view('livewire.components.modal');
    }
}
