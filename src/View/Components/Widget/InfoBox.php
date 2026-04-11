<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class InfoBox extends Component
{
    public $title;
    public $text;
    public $icon;
    public $description;
    public $url;
    public $urlTarget;
    public $theme;
    public $iconTheme;
    public $progress;
    public $progressTheme;

    public function __construct(
        $title = null,
        $text = null,
        $icon = null,
        $description = null,
        $url = null,
        $urlTarget = '_self',
        $theme = null,
        $iconTheme = null,
        $progress = null,
        $progressTheme = 'white'
    ) {
        $this->title = $title;
        $this->text = $text;
        $this->icon = $icon;
        $this->description = $description;
        $this->url = $url;
        $this->urlTarget = $urlTarget;
        $this->theme = $theme;
        $this->iconTheme = $iconTheme;
        $this->progress = isset($progress) ? max(min($progress, 100), 0) : null;
        $this->progressTheme = $progressTheme;
    }

    public function boxClasses(): string
    {
        $base = 'flex items-center px-4 py-2 rounded shadow-md overflow-hidden m-1';
        $theme = $this->theme ? $this->bgColor() : 'bg-white dark:bg-zinc-700';

        return "$base $theme";
    }

    public function iconClasses(): string
    {
        $base = 'flex items-center justify-center w-16 h-16 rounded-full text-white text-3xl';
        $theme = $this->iconTheme ? $this->iconBgColor() : 'bg-gray-400';

        return "$base $theme";
    }

    public function progressBarClasses(): string
    {
        $theme = match ($this->progressTheme) {
            'primary'   => 'bg-blue-600',
            'secondary' => 'bg-gray-500',
            'success'   => 'bg-green-600',
            'info'      => 'bg-cyan-500',
            'warning'   => 'bg-yellow-400',
            'danger'    => 'bg-red-600',
            'light'     => 'bg-gray-100',
            'dark'      => 'bg-gray-800',
            default     => 'bg-white',
        };

        return $theme;
    }

    public function bgColor(): string
    {
        return match ($this->theme) {
            'primary'   => 'bg-blue-600 text-white dark:bg-blue-900',
            'secondary' => 'bg-gray-500 text-white dark:bg-gray-900',
            'success'   => 'bg-green-600 text-white dark:bg-green-900',
            'info'      => 'bg-cyan-500 text-white dark:bg-cyan-900',
            'warning'   => 'bg-yellow-400 text-black dark:bg-yellow-900 dark:text-white',
            'danger'    => 'bg-red-600 text-white dark:bg-red-900',
            'light'     => 'bg-gray-100 text-black dark:bg-gray-900',
            'dark'      => 'bg-gray-800 text-white dark:bg-gray-900',
            default     => 'bg-white',
        };
    }

    public function iconBgColor(): string
    {
        return match ($this->iconTheme) {
            'primary'   => 'bg-blue-600',
            'secondary' => 'bg-gray-500',
            'success'   => 'bg-green-600',
            'info'      => 'bg-cyan-500',
            'warning'   => 'bg-yellow-400 text-black',
            'danger'    => 'bg-red-600',
            'light'     => 'bg-gray-100 text-black',
            'dark'      => 'bg-gray-800',
            default     => 'bg-gray-400',
        };
    }

    public function render()
    {
        return view('hwkui::components.widget.info-box');
    }
}
