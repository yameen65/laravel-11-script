<?php

namespace App\View\Components\Auth;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputCheckbox extends Component
{
    public $name;
    public $id;
    public $label;
    public $value;
    public $required;
    public $extraclasses;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $id, $label, $value = null, $required = null, $extraclasses = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->label = $label;
        $this->value = $value;
        $this->required = $required;
        $this->extraclasses = $extraclasses;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.auth.input-checkbox');
    }
}
