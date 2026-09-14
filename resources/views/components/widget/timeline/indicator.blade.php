@php

    $horizontal = $direction === 'horizontal';

    $palette = [
        'bg' => \Hawkiq\Hwkui\Support\Color::classes($color, 'progress'),
        'border' => \Hawkiq\Hwkui\Support\Color::classes($color, 'border'),
        'text' => \Hawkiq\Hwkui\Support\Color::classes($color, 'text'),
    ];

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
            {{ $lineClasses() }}
            {{ $palette['bg'] }}
        ">
        </div>
    @endif

</div>
