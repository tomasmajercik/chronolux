<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Order extends Component
{
    public $url;
    public $orderDate;
    public $orderNumber;
    public $total;
    public $address;
    public $images;

    public function __construct(
        $url,
        $orderDate,
        $orderNumber,
        $total,
        $address,
        $images = []
    ) {
        $this->url = $url;
        $this->orderDate = $orderDate;
        $this->orderNumber = $orderNumber;
        $this->total = $total;
        $this->address = $address;
        $this->images = $images;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order');
    }
}

