<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class Marquee extends Component
{
    public $direction;
    public $duration;
    public $gap;
    public $pauseOnHover;
    public $fade;

    public function __construct(
        $direction = 'left',
        $duration = '20s',
        $gap = '1rem',
        $pauseOnHover = false,
        $fade = false,
    ) {
        $this->direction = $direction;
        $this->duration = $duration;
        $this->gap = $gap;
        $this->pauseOnHover = $pauseOnHover;
        $this->fade = $fade;
    }

    public function render()
    {
        return view('hwkui::components.widget.marquee');
    }

}