<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

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
        if ($this->solid) {
            $colors = [
                'primary'   => 'bg-blue-600 text-white border-blue-900 dark:bg-blue-700 dark:border-blue-800',
                'secondary' => 'bg-slate-600 text-white border-slate-900 dark:bg-slate-700 dark:border-slate-800',
                'success'   => 'bg-emerald-600 text-white border-emerald-900 dark:bg-emerald-700 dark:border-emerald-800',
                'danger'    => 'bg-red-600 text-white border-red-900 dark:bg-red-700 dark:border-red-800',
                'warning'   => 'bg-amber-500 text-amber-950 border-amber-900 dark:bg-amber-600 dark:text-amber-950 dark:border-amber-700',
                'info'      => 'bg-sky-600 text-white border-sky-900 dark:bg-sky-700 dark:border-sky-800',
                'violet'    => 'bg-violet-600 text-white border-violet-900 dark:bg-violet-700 dark:border-violet-800',
                'pink'      => 'bg-pink-600 text-white border-pink-900 dark:bg-pink-700 dark:border-pink-800',
            ];
        } else {
            $colors = [
                'primary'   => 'bg-blue-50 text-blue-800 border-blue-400 dark:bg-blue-950/40 dark:text-blue-300 dark:border-blue-900/60',
                'secondary' => 'bg-slate-50 text-slate-800 border-slate-400 dark:bg-slate-900/40 dark:text-slate-300 dark:border-slate-800',
                'success'   => 'bg-emerald-50 text-emerald-800 border-emerald-400 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-900/60',
                'danger'    => 'bg-red-50 text-red-800 border-red-400 dark:bg-red-950/40 dark:text-red-300 dark:border-red-900/60',
                'warning'   => 'bg-amber-50 text-amber-800 border-amber-400 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-900/60',
                'info'      => 'bg-sky-50 text-sky-800 border-sky-400 dark:bg-sky-950/40 dark:text-sky-300 dark:border-sky-900/60',
                'violet'    => 'bg-violet-50 text-violet-800 border-violet-400 dark:bg-violet-950/40 dark:text-violet-300 dark:border-violet-900/60',
                'pink'      => 'bg-pink-50 text-pink-800 border-pink-400 dark:bg-pink-950/40 dark:text-pink-300 dark:border-pink-900/60',
            ];
        }


        return $colors[$this->color] ?? $colors['primary'];
    }

    public function render()
    {
        return view('hwkui::components.widget.alert');
    }
}
