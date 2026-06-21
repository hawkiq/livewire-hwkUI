<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Accordion;

use Illuminate\View\Component;

class Item extends Component
{
    public $heading;
    public $icon;
    public $disabled;

    public function __construct($heading = null, $icon = 'chevron-down', $disabled = false)
    {
        $this->heading = $heading;
        $this->icon = $icon;
        $this->disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN) || $disabled === '';
    }

    public function render()
    {
        return view('hwkui::components.widget.accordion.item');
    }
}
