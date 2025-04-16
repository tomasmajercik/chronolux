<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cartItem extends Component
{
    public $title, $price, $image, $size, $amount;

    public function __construct($title, $price, $image, $size, $amount)
    {
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
        $this->size = $size;
        $this->amount = $amount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-item');
    }
}
