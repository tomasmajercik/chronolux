<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class watchCategoryPreview extends Component
{
    public $categoryName, $description, $link;

    public function __construct($categoryName, $description, $link)
    {
        $this->categoryName = $categoryName;
        $this->description = $description;
        $this->link = $link;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.watch-category-preview');
    }
}
