<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderDetailItem extends Component
{
    public $title;
    public $image;
    public $size;
    public $amount;
    public $price;
    public $id;

    public function __construct($title, $image, $size, $amount, $price, $id)
    {
        $this->title = $title;
        $this->image = $image;
        $this->size = $size;
        $this->amount = $amount;
        $this->price = $price;
        $this->id = $id;
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order-detail-item');
    }
}
