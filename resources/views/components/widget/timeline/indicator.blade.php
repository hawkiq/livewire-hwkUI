@php

    $horizontal = $direction === 'horizontal';

    $colors = [
        'primary' => [
            'bg' => 'bg-blue-500',
            'border' => 'border-blue-500',
            'text' => 'text-blue-500',
        ],

        'success' => [
            'bg' => 'bg-green-500',
            'border' => 'border-green-500',
            'text' => 'text-green-500',
        ],

        'danger' => [
            'bg' => 'bg-red-500',
            'border' => 'border-red-500',
            'text' => 'text-red-500',
        ],

        'warning' => [
            'bg' => 'bg-yellow-500',
            'border' => 'border-yellow-500',
            'text' => 'text-yellow-500',
        ],

        'pink' => [
            'bg' => 'bg-pink-500',
            'border' => 'border-pink-500',
            'text' => 'text-pink-500',
        ],

        'violet' => [
            'bg' => 'bg-violet-500',
            'border' => 'border-violet-500',
            'text' => 'text-violet-500',
        ],

        'gray' => [
            'bg' => 'bg-gray-500',
            'border' => 'border-gray-500',
            'text' => 'text-gray-500',
        ],

        'emerald' => [
            'bg' => 'bg-emerald-500',
            'border' => 'border-emerald-500',
            'text' => 'text-emerald-500',
        ],

        'sky' => [
            'bg' => 'bg-sky-500',
            'border' => 'border-sky-500',
            'text' => 'text-sky-500',
        ],

        'dark' => [
            'bg' => 'bg-black dark:bg-white',
            'border' => 'border-black dark:border-white',
            'text' => 'text-black dark:text-white',
        ],
    ];

    if ($color == null || $colors[$color] == null) {
        $palette = $colors['primary'];
    } else {
        $palette = $colors[$color];
    }

    $baseClasses = match ($variant) {
        'borderless' => implode(' ', [$palette['text'], 'bg-transparent']),

        default => implode(' ', [$palette['bg'], 'text-white']),
    };

@endphp

<div class="relative flex items-center {{ $horizontal ? 'flex-row justify-center w-7' : 'flex-col' }}">

    <div
        class="
            w-7
            h-7
            text-xs
            rounded-full
            flex
            items-center
            justify-center
            shrink-0
            z-10
            {{ $baseClasses }}
        ">
        {{ $slot }}
    </div>

    @if ($state !== 'last')
        <div
            class="
            {{ $horizontal ? 'absolute left-full top-5 h-0.5 w-24 -translate-y-1/2' : 'w-0.5 h-5 mt-1' }}
            {{ $palette['bg'] }}
        ">
        </div>
    @endif

</div>
