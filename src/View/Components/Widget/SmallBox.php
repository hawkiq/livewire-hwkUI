<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

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
        $base = 'relative rounded shadow-md p-4 overflow-hidden flex flex-col justify-between m-1';
        $theme = $this->theme ? $this->bgColor() : 'bg-white dark:bg-zinc-700';

        return "$base $theme";
    }

    public function bgColor(): string
    {
        return match ($this->theme) {
            'primary'   => 'bg-blue-600 text-white dark:bg-blue-900',
            'secondary' => 'bg-gray-500 text-white dark:bg-gray-900',
            'success'   => 'bg-green-600 text-white dark:bg-green-900',
            'info'      => 'bg-cyan-500 text-white dark:bg-cyan-900',
            'warning'   => 'bg-yellow-400 text-black dark:bg-yellow-900',
            'danger'    => 'bg-red-600 text-white dark:bg-red-900',
            'light'     => 'bg-gray-100 text-black dark:bg-gray-200',
            'dark'      => 'bg-gray-800 text-white dark:bg-gray-800',
            default     => 'bg-white dark:bg-zinc-700',
        };
    }

    public function render()
    {
        return view('hwkui::components.widget.small-box');
    }
}
