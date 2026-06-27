<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class FlipCard extends Component
{
    public string $trigger;
    public string $height;

    public function __construct(string $trigger = 'hover', string $height = '300px')
    {
        $this->trigger = in_array($trigger, ['hover', 'click']) ? $trigger : 'hover';
        $this->height = is_numeric($height) ? $height . 'px' : $height;
    }

    public function render()
    {
        return view('hwkui::components.widget.flip-card');
    }
}
