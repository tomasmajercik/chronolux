<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Order extends Component
{
    // public string $placed_at;
    // public string $total;
    // public string $shipping_address;
    // public string $order_number;
    // public string $order_detail_route;
    // public array $images;
    // public string $estimated_delivery;

    // public function __construct(
    //     string $placed_at,
    //     string $total,
    //     string $shipping_address,
    //     string $order_number,
    //     string $order_detail_route,
    //     array $images,
    //     string $estimated_delivery) {
    //     $this->placed_at = $placed_at;
    //     $this->total = $total;
    //     $this->shipping_address = $shipping_address;
    //     $this->order_number = $order_number;
    //     $this->order_detail_route = $order_detail_route;
    //     $this->images = $images;
    //     $this->estimated_delivery = $estimated_delivery;
    // }
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order');
    }
}
