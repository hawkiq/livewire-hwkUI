<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class Typewriter extends Component
{
    public $words;
    public $typeSpeed;
    public $deleteSpeed;
    public $cursor;
    public $loop;
    public $pauseTime;

    public function __construct(
        $words = [],
        $typeSpeed = 70,
        $deleteSpeed = 35,
        $cursor = true,
        $loop = true,
        $pauseTime = 1500,
    ) {
        $this->words = $words;
        $this->typeSpeed =  (int)$typeSpeed;
        $this->deleteSpeed =  (int)$deleteSpeed;
        $this->cursor = filter_var($cursor, FILTER_VALIDATE_BOOLEAN);;
        $this->loop = filter_var($loop, FILTER_VALIDATE_BOOLEAN);;
        $this->pauseTime = (int)$pauseTime;
    }

    public function render()
    {
        return view('hwkui::components.widget.typewriter');
    }
}
