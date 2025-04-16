<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductContainer extends Component
{
    public string $url;
    public string $image;
    public string $title;
    public string $reviews;
    public float $price;

    public function __construct(
        string $url,
        string $image,
        string $title,
        string $reviews,
        float $price
    ) {
        $this->url = $url;
        $this->image = $image;
        $this->title = $title;
        $this->reviews = $reviews;
        $this->price = $price;
    }

    public function render(): View|Closure|string
    {
        return view('components.product-container');
    }
}
