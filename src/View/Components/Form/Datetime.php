<?php

namespace Hawkiq\Hwkui\View\Components\Form;

use Illuminate\View\Component;

class Datetime extends Component
{
    public $options = [];
    public $label = null;
    public $placeholder = null;



    public function __construct($options = [], $label = null, $placeholder = null)
    {
        $this->label = $label;
        $this->placeholder = $placeholder;

        $defaultOptions = config('hwkui.datetime.defaultOptions', [
            'display' => [
                'viewMode' => 'calendar',
                'components' => [
                    'calendar' => true,
                    'date' => true,
                    'year' => true,
                    'month' => true,
                    'clock' => true,
                ],
                'calendarWeeks' => true,
            ],
            'debug' => false,
            'useCurrent' => true,
            'stepping' => 1,
            'localization' => [
                'format' => 'yyyy-MM-dd hh:mm:ss',
                'locale' => app()->getLocale(),
            ],
        ]);

        $userOptions = is_array($options) ? $options : json_decode($options, true) ?? [];

        $this->options = array_replace_recursive($defaultOptions, $userOptions);
    }


    public function render()
    {
        return view('hwkui::components.form.datetime');
    }
}
