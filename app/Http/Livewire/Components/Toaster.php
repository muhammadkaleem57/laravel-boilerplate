<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Toaster extends Component
{
    protected $listeners = [
        'toasterSuccess' => 'toasterSuccess',
        'toasterInfo' => 'toasterInfo',
        'toasterWarning' => 'toasterWarning',
        'toasterError' => 'toasterError',
    ];

    public function toasterSuccess(string $message = '')
    {
        if ($message)
            $this->dispatchBrowserEvent('toaster:success', $message);
    }

    public function toasterInfo(string $message = '')
    {
        if ($message)
            $this->dispatchBrowserEvent('toaster:warning', $message);
    }

    public function toasterWarning(string $message = '')
    {
        if ($message)
            $this->dispatchBrowserEvent('toaster:info', $message);
    }

    public function toasterError(string $message = '')
    {
        if ($message)
            $this->dispatchBrowserEvent('toaster:error', $message);
    }

    public function render()
    {
        return view('livewire.components.toaster');
    }
}
