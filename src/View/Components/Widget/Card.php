<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Hawkiq\Hwkui\Support\Color;
use Illuminate\View\Component;

class Card extends Component
{
    public $title;

    public $icon;

    public $theme;

    public $themeMode;

    public $headerClass;

    public $bodyClass;

    public $footerClass;

    public $disabled;

    public function __construct(
        $title = null,
        $icon = null,
        $theme = null,
        $themeMode = null,
        $headerClass = null,
        $bodyClass = null,
        $footerClass = null,
        $disabled = false,
    ) {
        $this->title = $title;
        $this->icon = $icon;
        $this->theme = $theme;
        $this->themeMode = $themeMode;
        $this->headerClass = $headerClass;
        $this->bodyClass = $bodyClass;
        $this->footerClass = $footerClass;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('hwkui::components.widget.card');
    }

    public function cardClasses(): string
    {
        $base = 'relative rounded-2xl shadow-md overflow-hidden m-1';
        $color = match ($this->themeMode) {
            'full' => $this->bgColor().' text-white',
            'outline' => 'border border-t-7 '.$this->borderColor().' bg-white dark:bg-zinc-700',
            default => 'bg-white dark:bg-zinc-700'
        };

        return "$base $color";
    }

    public function headerClasses(): string
    {
        $base = 'flex justify-between items-center px-4 py-3 font-semibold';
        $theme = match ($this->themeMode) {
            'full' => 'text-white',
            'outline' => '',
            default => $this->theme ? $this->bgColor().' text-white' : 'bg-gray-100'
        };

        return trim("$base $theme {$this->headerClass}");
    }

    public function bodyClasses(): string
    {
        return "px-4 py-3 text-sm {$this->bodyClass}";
    }

    public function footerClasses(): string
    {
        return "px-4 py-2 border-t text-sm {$this->borderColor()}";
    }

    public function bgColor(): string
    {
        if (! Color::supports($this->theme)) {
            return 'bg-zinc-200 dark:bg-zinc-900';
        }

        return Color::classes($this->theme, 'solid');
    }

    public function borderColor(): string
    {
        if (! Color::supports($this->theme)) {
            return 'border-gray-300';
        }

        return Color::classes($this->theme, 'border');
    }
}
