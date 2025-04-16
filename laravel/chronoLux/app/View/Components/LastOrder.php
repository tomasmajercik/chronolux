<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LastOrder extends Component
{
    public string $orderDate;
    public array $imageSrcs;
    public string $status;
    public string $price;
    public string $detailLink;

    public function __construct(string $orderDate, array $imageSrcs, string $status, string $price, string $detailLink) {
        $this->orderDate = $orderDate;
        $this->imageSrcs = $imageSrcs;
        $this->status = $status;
        $this->price = $price;
        $this->detailLink = $detailLink;
    }

    public function render(): View|Closure|string
    {
        return view('components.last-order');
    }
}
