<?php

namespace Hawkiq\Hwkui\View\Components\Form;

use Illuminate\View\Component;

class FlatPicker extends Component
{
    public $options = [];
    public $label = null;
    public $placeholder = null;



    public function __construct($options = [], $label = null, $placeholder = null)
    {
        $this->label = $label;
        $this->placeholder = $placeholder;

        $defaultOptions = config('hwkui.flat-picker.defaultOptions', [
            'enableTime' => true,
            'dateFormat' => 'Y-m-d H:i',
            'time_24hr' => true,
            'allowInput' => false,
            'altInput' => true,
            'altFormat' => 'Y-m-d H:i',
            'minuteIncrement' => 5,
        ]);

        $userOptions = is_array($options) ? $options : json_decode($options, true) ?? [];

        $this->options = array_replace_recursive($defaultOptions, $userOptions);
    }


    public function render()
    {
        return view('hwkui::components.form.flat-picker');
    }
}
