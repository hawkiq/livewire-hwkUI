<?php

namespace Hawkiq\Hwkui\View\Components\Widget;

use Illuminate\View\Component;

class GlassBox extends Component
{
    public string $title;
    public int|float $value;
    public string $icon;
    public string $href;
    public string $color;

    public function __construct(
        string $title,
        int|float $value,
        string $icon,
        string $href = '#',
        string $color = 'zinc'
    ) {
        $this->title = $title;
        $this->value = $value;
        $this->icon = $icon;
        $this->href = $href;
        $this->color = $color;
    }

    public function cardClasses(): string
    {
        $base = '
        group
        relative
        overflow-hidden
        rounded-3xl
        border
        backdrop-blur-2xl
        supports-[backdrop-filter]:backdrop-blur-2xl
        p-5
        transition-all
        duration-300
        hover:-translate-y-1
        hover:shadow-2xl
        shadow-lg
    ';

        return $base . ' ' . match ($this->color) {

            'blue' => '
            bg-blue-100 dark:bg-blue-950/20
            border-white/30 dark:border-blue-400/10
            shadow-blue-500/10
        ',

            'emerald' => '
            bg-emerald-50 dark:bg-emerald-950/20
            border-white/30 dark:border-emerald-400/10
            shadow-emerald-500/10
        ',

            'amber' => '
            bg-amber-50 dark:bg-amber-950/20
            border-white/30 dark:border-amber-400/10
            shadow-amber-500/10
        ',

            'red' => '
            bg-red-100 dark:bg-red-900/20
            border-white/30 dark:border-rose-400/10
            shadow-rose-500/10
        ',

            'violet' => '
            bg-violet-300 dark:bg-violet-950/20
            border-white/30 dark:border-violet-400/10
            shadow-violet-500/10
        ',

            'cyan' => '
            bg-cyan-100 dark:bg-cyan-950/20
            border-white/30 dark:border-cyan-400/10
            shadow-cyan-500/10
            text-zinc-900 dark:text-900
        ',

            default => '
            bg-zinc-50 dark:bg-zinc-900/30 text-zinc-100 dark:text-zinc-900
            border-white/30 dark:border-zinc-700/30
            shadow-black/5
            text-zinc-900 dark:text-900
        ',
        };
    }

    public function iconClasses(): string
    {
        $base = '
        flex
        size-14
        items-center
        justify-center
        rounded-2xl
        border
        backdrop-blur-xl
        shadow-inner
    ';

        return $base . ' ' . match ($this->color) {

            'blue' => '
            bg-blue-500/10
            border-blue-200/30 dark:border-blue-400/10
            text-blue-700 dark:text-blue-300
        ',

            'emerald' => '
            bg-emerald-500/10
            border-emerald-200/30 dark:border-emerald-400/10
            text-emerald-700 dark:text-emerald-300
        ',

            'amber' => '
            bg-amber-500/10
            border-amber-200/30 dark:border-amber-400/10
            text-amber-700 dark:text-amber-300
        ',

            'rose' => '
            bg-rose-500/10
            border-rose-200/30 dark:border-rose-400/10
            text-rose-700 dark:text-rose-300
        ',

            'violet' => '
            bg-violet-500/10
            border-violet-200/30 dark:border-violet-400/10
            text-violet-700 dark:text-violet-300
        ',

            'cyan' => '
            bg-cyan-500/10
            border-cyan-200/30 dark:border-cyan-400/10
            text-cyan-700 dark:text-cyan-300
        ',

            default => '
            bg-zinc-500/10
            border-zinc-200/30 dark:border-zinc-700/30
            text-zinc-700 dark:text-zinc-200
        ',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this->color) {
            'blue' => 'bg-blue-600/70 dark:bg-blue-800/50',
            'emerald' => 'bg-emerald-200/70 dark:bg-emerald-800/50',
            'amber' => 'bg-amber-200/70 dark:bg-amber-800/50',
            'red' => 'bg-red-200/70 dark:bg-red-800/50',
            'violet' => 'bg-violet-200/70 dark:bg-violet-800/50',
            'cyan' => 'bg-cyan-200/70 dark:bg-cyan-800/50',
            default => 'bg-zinc-300/70 dark:bg-zinc-700',
        };
    }

    public function formattedValue(): string
    {
        return number_format($this->value);
    }

    public function render()
    {
        return view('hwkui::components.widget.glass-box');
    }
}
