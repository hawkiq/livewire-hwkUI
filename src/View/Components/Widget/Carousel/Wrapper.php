<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Carousel;

use Illuminate\View\Component;

class Wrapper extends Component
{
    public $items;
    public $interval;

    public function __construct($items, $interval = 5000)
    {
        $this->items = $items;
        $this->interval = $interval;
    }

    public function render()
    {
        return view('hwkui::components.widget.carousel.wrapper');
    }
}
