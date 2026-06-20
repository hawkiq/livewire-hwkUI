<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Tabs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tabs extends Component
{
    public function __construct(
        public string $default = 'tab1',
        public string $variant = 'classic', // options: 'pills', 'classic'
        public string $color = 'primary'
    ) {
        if (!in_array($this->variant, ['pills', 'classic'])) {
            $this->variant = 'classic';
        }

        $allowedColors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'violet', 'pink', 'dark', 'light'];
        if (!in_array($this->color, $allowedColors)) {
            $this->color = 'primary';
        }
    }

    public function render(): View
    {
        return view('hwkui::components.widget.tabs.tabs');
    }
}
