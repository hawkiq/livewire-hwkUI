<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class Tour extends Component
{
    public bool $open;
    public array $steps;

    public function __construct(bool $open = false, $steps = [])
    {
        $this->steps = $steps;
        $this->open = filter_var($open, FILTER_VALIDATE_BOOLEAN);
    }

    public function render()
    {
        return view('hwkui::components.widget.tour');
    }
}
