<?php

namespace App\View\Components\Jet;

use Illuminate\View\Component;

class Loader extends Component
{
    public ?string $target = null;

    public function __construct(?string $target = null)
    {
        $this->target = $target;
    }

    public function render()
    {
        return view('components.jet.loader');
    }
}
