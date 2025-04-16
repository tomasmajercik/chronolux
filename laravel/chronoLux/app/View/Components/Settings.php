<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Settings extends Component
{
    public string $settingText;
    public function __construct(string $settingText)
    {
        $this->settingText = $settingText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.settings');
    }
}
