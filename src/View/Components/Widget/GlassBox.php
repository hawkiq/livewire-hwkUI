<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Hawkiq\Hwkui\Support\Color;
use Illuminate\View\Component;

class GlassBox extends Component
{
    public string $title;

    public int|float|string $value;

    public string $icon;

    public string $href;

    public string $color;

    public function __construct(
        string $title,
        int|float|string $value,
        string $icon,
        string $href = '#',
        string $color = 'zinc'
    ) {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->href = $href;
        $this->color = $color;
    }

    public function cardClasses(): string
    {
        $base = '
        group
        relative
        overflow-hidden
        rounded-3xl
        border
        backdrop-blur-2xl
        supports-[backdrop-filter]:backdrop-blur-2xl
        p-5
        transition-all
        duration-300
        hover:-translate-y-1
        hover:shadow-2xl
        shadow-lg
    ';

        return $base.' '.Color::classes(Color::supports($this->color) ? $this->color : 'zinc', 'glass');
    }

    public function iconClasses(): string
    {
        $base = '
        flex
        size-14
        items-center
        justify-center
        rounded-2xl
        border
        backdrop-blur-xl
        shadow-inner
    ';

        return $base.' '.Color::classes(Color::supports($this->color) ? $this->color : 'zinc', 'glass-icon');
    }

    public function badgeClasses(): string
    {
        return Color::classes(Color::supports($this->color) ? $this->color : 'zinc', 'glass-badge');
    }

    public function formattedValue(): string
    {
        if (is_numeric($this->value)) {
            return number_format($this->value);
        }

        return $this->value;
    }

    public function render()
    {
        return view('hwkui::components.widget.glass-box');
    }
}
