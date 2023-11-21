<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OurServices extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $services;

    public function __construct($name,$services)
    {
        $this->name = $name;
        $this->services = $services;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.our-services');
    }
}
