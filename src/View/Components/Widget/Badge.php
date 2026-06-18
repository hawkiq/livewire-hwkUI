<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class Badge extends Component
{
    public string $variant;
    public string $color;
    public ?string $icon;
    public string $size;

    public function __construct(string $variant = 'solid', string $color = 'primary', string $size = 'sm',?string $icon = null)
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
        $fallback = 'primary';

        $solidColors = [
            'primary'   => 'bg-blue-600 text-white border-blue-700 dark:bg-blue-500 dark:border-blue-600',
            'secondary' => 'bg-slate-600 text-white border-slate-700 dark:bg-slate-500 dark:border-slate-600',
            'success'   => 'bg-emerald-600 text-white border-emerald-700 dark:bg-emerald-500 dark:border-emerald-600',
            'emerald'   => 'bg-emerald-600 text-white border-emerald-700 dark:bg-emerald-500 dark:border-emerald-600',
            'danger'    => 'bg-red-600 text-white border-red-700 dark:bg-red-500 dark:border-red-600',
            'warning'   => 'bg-amber-500 text-white border-amber-600 dark:bg-amber-500 dark:border-amber-600',
            'info'      => 'bg-sky-600 text-white border-sky-700 dark:bg-sky-500 dark:border-sky-600',
            'violet'    => 'bg-violet-600 text-white border-violet-700 dark:bg-violet-500 dark:border-violet-600',
            'pink'      => 'bg-pink-600 text-white border-pink-700 dark:bg-pink-500 dark:border-pink-600',
            'dark'      => 'bg-slate-900 text-white border-slate-950 dark:bg-slate-800 dark:border-slate-700',
            'light'     => 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-700 dark:text-slate-100 dark:border-slate-600',
        ];

        $ghostColors = [
            'primary'   => 'bg-blue-50 text-blue-800 border-blue-200 dark:bg-blue-950/40 dark:text-blue-300 dark:border-blue-900/60',
            'secondary' => 'bg-slate-50 text-slate-800 border-slate-200 dark:bg-slate-900/40 dark:text-slate-300 dark:border-slate-800',
            'success'   => 'bg-emerald-50 text-emerald-800 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-900/60',
            'emerald'   => 'bg-emerald-50 text-emerald-800 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-900/60',
            'danger'    => 'bg-red-50 text-red-800 border-red-200 dark:bg-red-950/40 dark:text-red-300 dark:border-red-900/60',
            'warning'   => 'bg-amber-50 text-amber-800 border-amber-200 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-900/60',
            'info'      => 'bg-sky-50 text-sky-800 border-sky-200 dark:bg-sky-950/40 dark:text-sky-300 dark:border-sky-900/60',
            'violet'    => 'bg-violet-50 text-violet-800 border-violet-200 dark:bg-violet-950/40 dark:text-violet-300 dark:border-violet-900/60',
            'pink'      => 'bg-pink-50 text-pink-800 border-pink-200 dark:bg-pink-950/40 dark:text-pink-300 dark:border-pink-900/60',
            'dark'      => 'bg-slate-100 text-slate-900 border-slate-300 dark:bg-slate-950/60 dark:text-slate-300 dark:border-slate-800',
            'light'     => 'bg-white text-slate-600 border-slate-150 dark:bg-slate-900/20 dark:text-slate-400 dark:border-slate-800',
        ];

        if ($this->variant === 'ghost') {
            return $ghostColors[$this->color] ?? $ghostColors[$fallback];
        }

        return $solidColors[$this->color] ?? $solidColors[$fallback];
    }

    public function render()
    {
        return view('hwkui::components.widget.badge');
    }
}
