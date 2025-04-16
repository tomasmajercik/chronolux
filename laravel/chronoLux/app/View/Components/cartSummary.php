<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cartSummary extends Component
{
    public $buttonMessage;
    public $buttonUrl;

    public function __construct($buttonMessage, $buttonUrl)
    {
        $this->buttonMessage = $buttonMessage;
        $this->buttonUrl = $buttonUrl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-summary');
    }
}
