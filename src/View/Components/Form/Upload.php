<?php

namespace Hawkiq\Hwkui\View\Components\Form;

use Illuminate\View\Component;

class Upload extends Component
{
    public ?string $hint;
    public bool $preview;
    public bool $multiple;
    public ?int $max;

    public function __construct(
        ?string $hint = null,
        bool $preview = false,
        bool $multiple = false,
        ?int $max = null
    ) {
        $this->hint = $hint;
        $this->preview = $preview;
        $this->multiple = $multiple;
        $this->max = $max;
    }

    public function render()
    {
        return view('hwkui::components.form.upload');
        
    }
}