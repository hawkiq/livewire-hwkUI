<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Timeline;

use Hawkiq\Hwkui\Support\TimelineContext;
use Illuminate\View\Component;

class Item extends Component
{
    public string $direction;

    public function __construct(?string $direction = null)
    {
        $this->direction = $direction ?? TimelineContext::$direction;
    }

    public function render()
    {
        return view('hwkui::components.widget.timeline.item');
    }
}
