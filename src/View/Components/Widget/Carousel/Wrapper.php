<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Carousel;

use Illuminate\View\Component;

class Wrapper extends Component
{
    public int $items;

    public int $interval;

    public array $breakpoints;

    public bool $showControls = true;

    public bool $showIndicators = true;

    public bool $showCount = true;

    public function __construct(int $items, int $interval = 5000, array $breakpoints = ['default' => 1], bool $showControls = true, bool $showIndicators = true, bool $showCount = true)
    {
        $this->items = $items;
        $this->interval = $interval;
        $this->breakpoints = $breakpoints;
        $this->showControls = filter_var($showControls, FILTER_VALIDATE_BOOLEAN);
        $this->showIndicators = filter_var($showIndicators, FILTER_VALIDATE_BOOLEAN);
        $this->showCount = filter_var($showCount, FILTER_VALIDATE_BOOLEAN);
    }

    public function render()
    {
        return view('hwkui::components.widget.carousel.wrapper');
    }
}
