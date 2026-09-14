<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Hawkiq\Hwkui\Support\Color;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $color;

    public ?string $icon;

    public bool $animated;

    public bool $solid;

    public function __construct(string $color = 'primary', ?string $icon = null, mixed $animated = false, mixed $solid = false)
    {
        $this->color = strtolower($color);
        $this->icon = $icon;
        $this->animated = filter_var($animated, FILTER_VALIDATE_BOOLEAN);
        $this->solid = filter_var($solid, FILTER_VALIDATE_BOOLEAN);
    }

    public function getColorClasses(): string
    {
        return Color::classes($this->color, $this->solid ? 'solid' : 'soft');
    }

    public function render()
    {
        return view('hwkui::components.widget.alert');
    }
}
