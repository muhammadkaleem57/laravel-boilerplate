<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class ConfirmationModal extends Component
{
    public bool $isOpen = false;
    public ?string $recordId = '';
    public ?string $className = '';
    public ?string $type = '';
    public ?string $message = '';
    public ?string $event = '';

    public ?object $record = null;

    protected $listeners = ['show::ConfirmationModal' => 'open'];

    public function open(array $params)
    {
        $this->reset();

        $this->recordId = $params['id'] ?? '';
        $this->className = $params['className'] ?? '';
        $this->type = $params['type'] ?? '';
        $this->message = $params['message'] ?? '';
        $this->event = $params['event'] ?? '';

        $this->getRecord();

        if (!is_object($this->record))
            $this->emit('toasterError', 'Record not found.');
        else{
            $this->isOpen = true;
            $this->dispatchBrowserEvent('show-confirmation-modal');
        }
    }

    public function closeConfirmation()
    {
        $this->reset();

        $this->dispatchBrowserEvent('close-confirmation-modal');
        $this->dispatchBrowserEvent('close-modal-backdrop');
    }

    public function render()
    {
        return view('livewire.components.confirmation-modal');
    }

    public function enableDisable()
    {
        $this->record->is_active = $this->record->isActive() ? NO : YES;
        $this->record->saveQuietly();

        $this->emitEvents($this->type.'.');
    }

    public function verify()
    {
        $this->record->email_verified_at = now()->toDateTimeString();
        $this->record->is_active = YES;
        $this->record->verification_code = null;
        $this->record->saveQuietly();

        $this->emitEvents('verified.');
    }

    public function delete()
    {
        $this->record->delete();
        $this->emitEvents('deleted.');
    }

    private function getRecord()
    {
        $this->record = $this->className::find(decodeID($this->recordId));
    }

    private function emitEvents($message = '')
    {
        if ($this->event)
            $this->emit($this->event);

        $this->closeConfirmation();

        $this->emit('toasterSuccess', 'Successfully '.$message);
    }
}
