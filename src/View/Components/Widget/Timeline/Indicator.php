<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Timeline;

use Illuminate\View\Component;
use Hawkiq\Hwkui\Support\TimelineContext;

class Indicator extends Component
{
    public string $direction;
    public string $color;
    public function __construct(
        public string $variant = 'solid',
        public string $state = 'completed',
        ?string $direction = null,
        ?string $color = null,
    ) {
        $this->direction = $direction ?? TimelineContext::$direction;
        $this->color = filled($color) ? $color : TimelineContext::$color;
    }

    public function render()
    {
        return view('hwkui::components.widget.timeline.indicator');
    }
}
