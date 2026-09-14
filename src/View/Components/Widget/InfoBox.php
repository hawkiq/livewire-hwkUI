<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Hawkiq\Hwkui\Support\Color;
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
        $base = 'flex items-center px-4 py-2 rounded-3xl shadow-md overflow-hidden m-1';
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
        if (! Color::supports($this->progressTheme)) {
            return 'bg-white';
        }

        return Color::classes($this->progressTheme, 'progress');
    }

    public function bgColor(): string
    {
        if (! Color::supports($this->theme)) {
            return 'bg-white';
        }

        return Color::classes($this->theme, 'solid');
    }

    public function iconBgColor(): string
    {
        if (! Color::supports($this->iconTheme)) {
            return 'bg-gray-400';
        }

        return Color::classes($this->iconTheme, 'icon');
    }

    public function render()
    {
        return view('hwkui::components.widget.info-box');
    }
}
