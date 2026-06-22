<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Carousel;

use Illuminate\View\Component;

class Item extends Component
{
    public $index;

    public function __construct($index = 0)
    {
        $this->index = $index;
    }

    public function render()
    {
        return view('hwkui::components.widget.carousel.item');
    }
}
