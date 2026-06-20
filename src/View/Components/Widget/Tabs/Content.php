<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Tabs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Content extends Component
{
    public function __construct(
        public string $name
    ) {}

    public function render(): View
    {
        return view('hwkui::components.widget.tabs.content');
    }
}
