<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class reviewsHomepage extends Component
{
    public $text, $stars, $fullName;

    public function __construct($text, $stars, $fullName)
    {
        $this->text = $text;
        $this->stars = $stars;
        $this->fullName = $fullName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reviews-homepage');
    }
}
