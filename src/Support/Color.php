<?php

namespace Hawkiq\Hwkui\Support;

final class Color
{
    private const COLORS = [
        'primary' => [
            'solid' => 'bg-blue-600 text-white border-blue-700 dark:bg-blue-500 dark:border-blue-400',
            'icon' => 'bg-blue-600',
            'soft' => 'bg-blue-50 text-blue-800 border-blue-200 dark:bg-blue-950/40 dark:text-blue-300 dark:border-blue-900/60',
            'outline' => 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400',
            'border' => 'border-blue-600 dark:border-blue-400',
            'text' => 'text-blue-600 dark:text-blue-400',
            'progress' => 'bg-blue-600 dark:bg-blue-500',
            'glass' => 'bg-blue-50 dark:bg-blue-950/20 border-white/30 dark:border-blue-400/10 shadow-blue-500/10',
            'glass-icon' => 'bg-blue-500/10 border-blue-200/30 dark:border-blue-400/10 text-blue-700 dark:text-blue-300',
            'glass-badge' => 'bg-blue-200/70 dark:bg-blue-800/50',
        ],
        'success' => [
            'solid' => 'bg-green-600 text-white border-green-700 dark:bg-green-500 dark:border-green-400',
            'icon' => 'bg-green-600',
            'soft' => 'bg-green-50 text-green-800 border-green-200 dark:bg-green-950/40 dark:text-green-300 dark:border-green-900/60',
            'outline' => 'border-green-600 text-green-600 dark:border-green-400 dark:text-green-400',
            'border' => 'border-green-600 dark:border-green-400',
            'text' => 'text-green-600 dark:text-green-400',
            'progress' => 'bg-green-600 dark:bg-green-500',
            'glass' => 'bg-green-50 dark:bg-green-950/20 border-white/30 dark:border-green-400/10 shadow-green-500/10',
            'glass-icon' => 'bg-green-500/10 border-green-200/30 dark:border-green-400/10 text-green-700 dark:text-green-300',
            'glass-badge' => 'bg-green-200/70 dark:bg-green-800/50',
        ],
        'emerald' => [
            'solid' => 'bg-emerald-600 text-white border-emerald-700 dark:bg-emerald-500 dark:border-emerald-400',
            'icon' => 'bg-emerald-600',
            'soft' => 'bg-emerald-50 text-emerald-800 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-900/60',
            'outline' => 'border-emerald-600 text-emerald-600 dark:border-emerald-400 dark:text-emerald-400',
            'border' => 'border-emerald-600 dark:border-emerald-400',
            'text' => 'text-emerald-600 dark:text-emerald-400',
            'progress' => 'bg-emerald-600 dark:bg-emerald-500',
            'glass' => 'bg-emerald-50 dark:bg-emerald-950/20 border-white/30 dark:border-emerald-400/10 shadow-emerald-500/10',
            'glass-icon' => 'bg-emerald-500/10 border-emerald-200/30 dark:border-emerald-400/10 text-emerald-700 dark:text-emerald-300',
            'glass-badge' => 'bg-emerald-200/70 dark:bg-emerald-800/50',
        ],
        'warning' => [
            'solid' => 'bg-amber-500 text-amber-950 border-amber-600 dark:bg-amber-400 dark:border-amber-500',
            'icon' => 'bg-amber-500 text-amber-950',
            'soft' => 'bg-amber-50 text-amber-900 border-amber-200 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-900/60',
            'outline' => 'border-amber-500 text-amber-600 dark:border-amber-400 dark:text-amber-400',
            'border' => 'border-amber-500 dark:border-amber-400',
            'text' => 'text-amber-600 dark:text-amber-400',
            'progress' => 'bg-amber-500 dark:bg-amber-400',
            'glass' => 'bg-amber-50 dark:bg-amber-950/20 border-white/30 dark:border-amber-400/10 shadow-amber-500/10',
            'glass-icon' => 'bg-amber-500/10 border-amber-200/30 dark:border-amber-400/10 text-amber-700 dark:text-amber-300',
            'glass-badge' => 'bg-amber-200/70 dark:bg-amber-800/50',
        ],
        'danger' => [
            'solid' => 'bg-red-600 text-white border-red-700 dark:bg-red-500 dark:border-red-400',
            'icon' => 'bg-red-600',
            'soft' => 'bg-red-50 text-red-800 border-red-200 dark:bg-red-950/40 dark:text-red-300 dark:border-red-900/60',
            'outline' => 'border-red-600 text-red-600 dark:border-red-400 dark:text-red-400',
            'border' => 'border-red-600 dark:border-red-400',
            'text' => 'text-red-600 dark:text-red-400',
            'progress' => 'bg-red-600 dark:bg-red-500',
            'glass' => 'bg-red-50 dark:bg-red-950/20 border-white/30 dark:border-red-400/10 shadow-red-500/10',
            'glass-icon' => 'bg-red-500/10 border-red-200/30 dark:border-red-400/10 text-red-700 dark:text-red-300',
            'glass-badge' => 'bg-red-200/70 dark:bg-red-800/50',
        ],
        'info' => [
            'solid' => 'bg-cyan-600 text-white border-cyan-700 dark:bg-cyan-500 dark:border-cyan-400',
            'icon' => 'bg-cyan-600',
            'soft' => 'bg-cyan-50 text-cyan-800 border-cyan-200 dark:bg-cyan-950/40 dark:text-cyan-300 dark:border-cyan-900/60',
            'outline' => 'border-cyan-600 text-cyan-600 dark:border-cyan-400 dark:text-cyan-400',
            'border' => 'border-cyan-600 dark:border-cyan-400',
            'text' => 'text-cyan-600 dark:text-cyan-400',
            'progress' => 'bg-cyan-600 dark:bg-cyan-500',
            'glass' => 'bg-cyan-50 dark:bg-cyan-950/20 border-white/30 dark:border-cyan-400/10 shadow-cyan-500/10',
            'glass-icon' => 'bg-cyan-500/10 border-cyan-200/30 dark:border-cyan-400/10 text-cyan-700 dark:text-cyan-300',
            'glass-badge' => 'bg-cyan-200/70 dark:bg-cyan-800/50',
        ],
        'secondary' => [
            'solid' => 'bg-slate-600 text-white border-slate-700 dark:bg-slate-500 dark:border-slate-400',
            'icon' => 'bg-slate-600',
            'soft' => 'bg-slate-50 text-slate-800 border-slate-200 dark:bg-slate-900/40 dark:text-slate-300 dark:border-slate-800',
            'outline' => 'border-slate-600 text-slate-600 dark:border-slate-400 dark:text-slate-400',
            'border' => 'border-slate-600 dark:border-slate-400',
            'text' => 'text-slate-600 dark:text-slate-400',
            'progress' => 'bg-slate-600 dark:bg-slate-500',
            'glass' => 'bg-slate-50 dark:bg-slate-900/30 border-white/30 dark:border-slate-700/30 shadow-black/5',
            'glass-icon' => 'bg-slate-500/10 border-slate-200/30 dark:border-slate-700/30 text-slate-700 dark:text-slate-200',
            'glass-badge' => 'bg-slate-300/70 dark:bg-slate-700',
        ],
        'dark' => [
            'solid' => 'bg-slate-900 text-white border-slate-950 dark:bg-slate-800 dark:border-slate-700',
            'icon' => 'bg-slate-900',
            'soft' => 'bg-slate-100 text-slate-900 border-slate-300 dark:bg-slate-950/60 dark:text-slate-300 dark:border-slate-800',
            'outline' => 'border-slate-900 text-slate-900 dark:border-slate-200 dark:text-slate-200',
            'border' => 'border-slate-900 dark:border-slate-200',
            'text' => 'text-slate-900 dark:text-slate-200',
            'progress' => 'bg-slate-900 dark:bg-slate-700',
            'glass' => 'bg-slate-100 dark:bg-slate-900/30 border-white/30 dark:border-slate-700/30 shadow-black/5',
            'glass-icon' => 'bg-slate-500/10 border-slate-200/30 dark:border-slate-700/30 text-slate-700 dark:text-slate-200',
            'glass-badge' => 'bg-slate-300/70 dark:bg-slate-700',
        ],
        'light' => [
            'solid' => 'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-700 dark:text-slate-100 dark:border-slate-600',
            'icon' => 'bg-slate-100 text-slate-800',
            'soft' => 'bg-white text-slate-600 border-slate-200 dark:bg-slate-900/20 dark:text-slate-400 dark:border-slate-800',
            'outline' => 'border-slate-200 text-slate-800 dark:border-slate-600 dark:text-slate-200',
            'border' => 'border-slate-200 dark:border-slate-600',
            'text' => 'text-slate-800 dark:text-slate-200',
            'progress' => 'bg-slate-200 dark:bg-slate-600',
            'glass' => 'bg-white dark:bg-slate-900/20 border-white/30 dark:border-slate-700/30 shadow-black/5',
            'glass-icon' => 'bg-slate-500/10 border-slate-200/30 dark:border-slate-700/30 text-slate-700 dark:text-slate-200',
            'glass-badge' => 'bg-slate-200/70 dark:bg-slate-700',
        ],
        'violet' => [
            'solid' => 'bg-violet-600 text-white border-violet-700 dark:bg-violet-500 dark:border-violet-400',
            'icon' => 'bg-violet-600',
            'soft' => 'bg-violet-50 text-violet-800 border-violet-200 dark:bg-violet-950/40 dark:text-violet-300 dark:border-violet-900/60',
            'outline' => 'border-violet-600 text-violet-600 dark:border-violet-400 dark:text-violet-400',
            'border' => 'border-violet-600 dark:border-violet-400',
            'text' => 'text-violet-600 dark:text-violet-400',
            'progress' => 'bg-violet-600 dark:bg-violet-500',
            'glass' => 'bg-violet-50 dark:bg-violet-950/20 border-white/30 dark:border-violet-400/10 shadow-violet-500/10',
            'glass-icon' => 'bg-violet-500/10 border-violet-200/30 dark:border-violet-400/10 text-violet-700 dark:text-violet-300',
            'glass-badge' => 'bg-violet-200/70 dark:bg-violet-800/50',
        ],
        'pink' => [
            'solid' => 'bg-pink-600 text-white border-pink-700 dark:bg-pink-500 dark:border-pink-400',
            'icon' => 'bg-pink-600',
            'soft' => 'bg-pink-50 text-pink-800 border-pink-200 dark:bg-pink-950/40 dark:text-pink-300 dark:border-pink-900/60',
            'outline' => 'border-pink-600 text-pink-600 dark:border-pink-400 dark:text-pink-400',
            'border' => 'border-pink-600 dark:border-pink-400',
            'text' => 'text-pink-600 dark:text-pink-400',
            'progress' => 'bg-pink-600 dark:bg-pink-500',
            'glass' => 'bg-pink-50 dark:bg-pink-950/20 border-white/30 dark:border-pink-400/10 shadow-pink-500/10',
            'glass-icon' => 'bg-pink-500/10 border-pink-200/30 dark:border-pink-400/10 text-pink-700 dark:text-pink-300',
            'glass-badge' => 'bg-pink-200/70 dark:bg-pink-800/50',
        ],
        'sky' => [
            'solid' => 'bg-sky-600 text-white border-sky-700 dark:bg-sky-500 dark:border-sky-400',
            'icon' => 'bg-sky-600',
            'soft' => 'bg-sky-50 text-sky-800 border-sky-200 dark:bg-sky-950/40 dark:text-sky-300 dark:border-sky-900/60',
            'outline' => 'border-sky-600 text-sky-600 dark:border-sky-400 dark:text-sky-400',
            'border' => 'border-sky-600 dark:border-sky-400',
            'text' => 'text-sky-600 dark:text-sky-400',
            'progress' => 'bg-sky-600 dark:bg-sky-500',
            'glass' => 'bg-sky-50 dark:bg-sky-950/20 border-white/30 dark:border-sky-400/10 shadow-sky-500/10',
            'glass-icon' => 'bg-sky-500/10 border-sky-200/30 dark:border-sky-400/10 text-sky-700 dark:text-sky-300',
            'glass-badge' => 'bg-sky-200/70 dark:bg-sky-800/50',
        ],
        'zinc' => [
            'glass' => 'bg-zinc-50 dark:bg-zinc-900/30 text-zinc-900 border-white/30 dark:border-zinc-700/30 shadow-black/5',
            'glass-icon' => 'bg-zinc-500/10 border-zinc-200/30 dark:border-zinc-700/30 text-zinc-700 dark:text-zinc-200',
            'glass-badge' => 'bg-zinc-300/70 dark:bg-zinc-700',
        ],
    ];

    private const ALIASES = [
        'green' => 'success',
        'blue' => 'primary',
        'amber' => 'warning',
        'red' => 'danger',
        'cyan' => 'info',
        'rose' => 'pink',
        'gray' => 'secondary',
    ];

    public static function classes(?string $color, string $role = 'solid'): string
    {
        $color = self::normalize($color);

        return self::COLORS[$color][$role] ?? self::COLORS['primary']['solid'];
    }

    public static function normalize(?string $color): string
    {
        $color = strtolower((string) $color);
        $color = self::ALIASES[$color] ?? $color;

        return array_key_exists($color, self::COLORS) ? $color : 'primary';
    }

    public static function supports(?string $color): bool
    {
        $color = strtolower((string) $color);

        return array_key_exists($color, self::COLORS) || array_key_exists($color, self::ALIASES);
    }

    public static function names(): array
    {
        return array_merge(array_diff(array_keys(self::COLORS), ['zinc']), array_keys(self::ALIASES));
    }
}
