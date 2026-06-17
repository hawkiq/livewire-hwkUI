<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class Alert extends Component
{
    public string $color;
    public ?string $icon;
    public bool $animated;

    public function __construct(string $color = 'primary' , ?string $icon = null , mixed $animated = false)
    {
        $this->color = strtolower($color);
        $this->icon = $icon;
        $this->animated = filter_var($animated, FILTER_VALIDATE_BOOLEAN);
    }

    public function getColorClasses(): string
    {
        $colors = [
            'primary'   => 'bg-blue-50 text-blue-800 border-blue-200 dark:bg-blue-950/40 dark:text-blue-300 dark:border-blue-900/60',
            'secondary' => 'bg-slate-50 text-slate-800 border-slate-200 dark:bg-slate-900/40 dark:text-slate-300 dark:border-slate-800',
            'success'   => 'bg-emerald-50 text-emerald-800 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-900/60',
            'danger'    => 'bg-red-50 text-red-800 border-red-200 dark:bg-red-950/40 dark:text-red-300 dark:border-red-900/60',
            'warning'   => 'bg-amber-50 text-amber-800 border-amber-200 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-900/60',
            'info'      => 'bg-sky-50 text-sky-800 border-sky-200 dark:bg-sky-950/40 dark:text-sky-300 dark:border-sky-900/60',
            'violet'    => 'bg-violet-50 text-violet-800 border-violet-200 dark:bg-violet-950/40 dark:text-violet-300 dark:border-violet-900/60',
            'pink'      => 'bg-pink-50 text-pink-800 border-pink-200 dark:bg-pink-950/40 dark:text-pink-300 dark:border-pink-900/60',
        ];

        return $colors[$this->color] ?? $colors['primary'];
    }

    public function render()
    {
        return view('hwkui::components.widget.alert');
    }
}
