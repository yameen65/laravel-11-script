<?php

namespace App\View\Components\Auth;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $cardHeader = null;
    public $headerButton = null;
    public $extraBodyClass = null;

    /**
     * Create a new component instance.
     */
    public function __construct($cardHeader = null, $headerButton = null, $extraBodyClass = null)
    {
        $this->cardHeader = $cardHeader;
        $this->headerButton = $headerButton;
        $this->extraBodyClass = $extraBodyClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth.card');
    }
}
