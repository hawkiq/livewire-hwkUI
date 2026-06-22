<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Timeline;

use Illuminate\View\Component;
use Hawkiq\Hwkui\Support\TimelineContext;

class Indicator extends Component
{
    public string $direction;
    public string $color;
    public string $length;
    public function __construct(
        public string $variant = 'solid',
        public string $state = 'completed',
        ?string $direction = null,
        ?string $color = null,
        ?string $length = null,
    ) {
        $this->direction = $direction ?? TimelineContext::$direction;
        $this->color = filled($color) ? $color : TimelineContext::$color;
        $this->length = $length ?? TimelineContext::$length;
    }

    public function lineClasses(): string
    {
        if ($this->direction === 'horizontal') {
            return 'absolute left-full top-5 h-0.5 w-24 -translate-y-1/2';
        }

        $height = $this->length === 'long' ? 'h-20' : 'h-5';

        return "w-0.5 {$height} mt-1";
    }

    public function render()
    {
        return view('hwkui::components.widget.timeline.indicator');
    }
}
