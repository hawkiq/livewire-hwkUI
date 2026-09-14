<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Hawkiq\Hwkui\Support\Color;
use Illuminate\View\Component;

class Badge extends Component
{
    public string $variant;

    public string $color;

    public ?string $icon;

    public string $size;

    public function __construct(string $variant = 'solid', string $color = 'primary', string $size = 'sm', ?string $icon = null)
    {
        $this->variant = strtolower($variant);
        $this->color = strtolower($color);
        $this->icon = $icon;
        $this->size = strtolower($size);
    }

    public function getShapeClasses(): string
    {
        $base = 'font-medium inline-flex items-center gap-1 border';

        $radius = ($this->variant === 'pill') ? 'rounded-full' : 'rounded';

        $sizes = [
            'sm' => 'px-2 py-0.5 text-xs',
            'md' => 'px-2.5 py-1 text-sm',
            'lg' => 'px-3 py-1.5 text-base',
        ];

        $sizeClasses = $sizes[$this->size] ?? $sizes['sm'];

        return "{$base} {$radius} {$sizeClasses}";

    }

    public function getIconSizeClass(): string
    {
        $iconSizes = [
            'sm' => 'w-3 h-3',
            'md' => 'w-4 h-4',
            'lg' => 'w-5 h-5',
        ];

        return $iconSizes[$this->size] ?? $iconSizes['sm'];
    }

    public function getColorClasses(): string
    {
        return Color::classes($this->color, $this->variant === 'ghost' ? 'soft' : 'solid');
    }

    public function render()
    {
        return view('hwkui::components.widget.badge');
    }
}
