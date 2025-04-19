<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartSummary extends Component
{
    public $buttonMessage;
    public $buttonUrl;
    public $totalProducts;
    public $shipping;
    public $total;


    public function __construct($buttonMessage, $buttonUrl, $totalProducts, $shipping, $total)
    {
        $this->buttonMessage = $buttonMessage;
        $this->buttonUrl = $buttonUrl;
        $this->totalProducts = $totalProducts;
        $this->shipping = $shipping;
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-summary');
    }
}
