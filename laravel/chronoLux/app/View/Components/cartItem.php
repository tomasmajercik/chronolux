<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartItem extends Component
{
    public $title, $price, $image, $size, $amount, $itemId, $productId;

    public function __construct($title, $price, $image, $size, $amount, $itemId, $productId)
    {
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
        $this->size = $size;
        $this->amount = $amount;
        $this->itemId = $itemId;
        $this->productId = $productId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-item');
    }
}
