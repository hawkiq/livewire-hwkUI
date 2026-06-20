<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Tabs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentWrapper extends Component
{
    public function render(): View
    {
        return view('hwkui::components.widget.tabs.content-wrapper');
    }
}
