<?php

namespace Hawkiq\Hwkui\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{
    public $options = [];
    public $label = null;
    public $placeholder = null;

    public function __construct($options = [], $label = null, $placeholder = null)
    {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->options = is_array($options) ? $options : json_decode($options, true) ?? [];
    }


    public function render()
    {
        return view('hwkui::components.form.select');
    }
}
