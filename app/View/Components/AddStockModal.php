<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AddStockModal extends Component
{
    public $modalId;
    public $formAction;

    public function __construct($modalId = 'addStocksModal', $formAction = '#')
    {
        $this->modalId = $modalId;
        $this->formAction = $formAction;
    }

    public function render()
    {
        return view('components.addStockModal');
    }
}
