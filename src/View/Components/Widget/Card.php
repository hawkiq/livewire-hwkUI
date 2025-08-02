<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class Card extends Component
{
    public $title, $icon, $theme, $themeMode;
    public $headerClass, $bodyClass, $footerClass;
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
        $base = 'relative rounded shadow-md overflow-hidden mb-1';
        $color = match ($this->themeMode) {
            'full' => $this->bgColor() . ' text-white',
            'outline' => 'border border-t-7 ' . $this->borderColor() . ' bg-white dark:bg-zinc-700',
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
            default => $this->theme ? $this->bgColor() . ' text-white' : 'bg-gray-100'
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
        return match ($this->theme) {
            'primary' => 'bg-blue-600 dark:bg-blue-900',
            'secondary' => 'bg-gray-500 dark:bg-gray-700',
            'danger' => 'bg-red-600 dark:bg-red-900',
            'warning' => 'bg-yellow-400 text-black dark:bg-yellow-900',
            'success' => 'bg-green-600 dark:bg-green-900',
            'info' => 'bg-cyan-500 dark:bg-cyan-900',
            'light'     => 'bg-gray-100 text-black dark:bg-gray-200',
            'dark'      => 'bg-gray-800 text-white dark:bg-black',
            default => 'bg-zinc-200 dark:bg-zinc-900',
        };
    }

    public function borderColor(): string
    {
        return match ($this->theme) {
            'primary' => 'border-blue-600',
            'secondary' => 'border-gray-500',
            'danger' => 'border-red-600',
            'warning' => 'border-yellow-400',
            'success' => 'border-green-600',
            'info' => 'border-cyan-500',
            'light'     => 'border-gray-100',
            'dark'      => 'border-gray-800',
            default => 'border-gray-300',
        };
    }
}
