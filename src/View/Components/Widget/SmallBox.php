<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Hawkiq\Hwkui\Support\Color;
use Illuminate\View\Component;

class SmallBox extends Component
{
    public $title;

    public $text;

    public $icon;

    public $theme;

    public $url;

    public $urlText;

    public $urlIcon;

    public $loading;

    public function __construct(
        $title = null,
        $text = null,
        $icon = null,
        $theme = null,
        $url = null,
        $urlText = null,
        $urlIcon = null,
        $loading = false
    ) {
        $this->title = $title;
        $this->text = $text;
        $this->icon = $icon;
        $this->theme = $theme;
        $this->url = $url;
        $this->urlText = $urlText;
        $this->urlIcon = $urlIcon;
        $this->loading = $loading;
    }

    public function boxClasses(): string
    {
        $base = 'relative rounded-3xl shadow-md p-4 overflow-hidden flex flex-col justify-between m-1';
        $theme = $this->theme ? $this->bgColor() : 'bg-white dark:bg-zinc-700';

        return "$base $theme";
    }

    public function bgColor(): string
    {
        if (! Color::supports($this->theme)) {
            return 'bg-white dark:bg-zinc-700';
        }

        return Color::classes($this->theme, 'solid');
    }

    public function render()
    {
        return view('hwkui::components.widget.small-box');
    }
}
