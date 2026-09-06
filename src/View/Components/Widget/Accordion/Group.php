<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Accordion;

use Illuminate\View\Component;

class Group extends Component
{
    public $animation;

    public $collapse;

    public $color;

    public $expanded;

    public function __construct($animation = 'slide', $collapse = false, $color = 'primary', $expanded = false)
    {
        $this->animation = $animation;
        $this->collapse = filter_var($collapse, FILTER_VALIDATE_BOOLEAN) || $collapse === '';
        $this->color = $color;
        $this->expanded = filter_var($expanded, FILTER_VALIDATE_BOOLEAN) || $expanded === '';
    }

    public function render()
    {
        return view('hwkui::components.widget.accordion.group');
    }
}
