<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Timeline;

use Illuminate\View\Component;
use Hawkiq\Hwkui\Support\TimelineContext;

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
