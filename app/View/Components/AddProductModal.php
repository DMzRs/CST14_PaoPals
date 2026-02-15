<?php

namespace App\View\Components;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddProductModal extends Component
{
    public $modalId;
    public $formAction;

    /**
     * Create a new component instance.
     */
    public function __construct($modalId = 'addProductModal', $formAction = '#')
    {
        $this->modalId = $modalId;
        $this->formAction = $formAction;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.addProductModal');
    }
}
