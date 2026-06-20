<?php

namespace Hawkiq\Hwkui\View\Components\Widget\Tabs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Head extends Component
{
    public function __construct(
        public string $name,
        public ?string $icon = null,
        public ?string $badge = null,
        public string $badgeColor = 'danger'
    ) {}

    public function render(): View
    {
        return view('hwkui::components.widget.tabs.head');
    }
}
