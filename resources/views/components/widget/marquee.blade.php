@php
    $isVertical = in_array($direction, ['up', 'down']);
    $flexClass = $isVertical ? 'flex-col' : 'flex-row';
    $animClass = $isVertical ? 'animate-hwkui-marquee-y' : 'animate-hwkui-marquee-x';
    $animDirection = in_array($direction, ['right', 'down']) ? 'reverse' : 'normal';

    $maskImage = '';
    if ($fade) {
        $maskImage = $isVertical
            ? 'mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent); -webkit-mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent);'
            : 'mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent); -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);';
    }
@endphp

@once
<style>
    @keyframes hwkui-marquee-x {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-100% - var(--marquee-gap))); }
    }
    @keyframes hwkui-marquee-y {
        0% { transform: translateY(0); }
        100% { transform: translateY(calc(-100% - var(--marquee-gap))); }
    }
    .animate-hwkui-marquee-x {
        animation: hwkui-marquee-x var(--marquee-duration) linear infinite var(--marquee-direction);
    }
    .animate-hwkui-marquee-y {
        animation: hwkui-marquee-y var(--marquee-duration) linear infinite var(--marquee-direction);
    }
    .hwkui-pause-on-hover:hover .animate-hwkui-marquee-x,
    .hwkui-pause-on-hover:hover .animate-hwkui-marquee-y {
        animation-play-state: paused !important;
    }
</style>
@endonce

<div
    {{-- FIX: Add a custom class wrapper if pauseOnHover is true --}}
    {{ $attributes->merge(['class' => 'flex overflow-hidden ' . ($pauseOnHover ? 'hwkui-pause-on-hover ' : '') . ($isVertical ? 'flex-col h-full' : 'flex-row w-full')]) }}
    style="{!! $maskImage !!} gap: var(--marquee-gap); --marquee-gap: {{ $gap }};"
>
    <div
        class="flex shrink-0 justify-around {{ $flexClass }} {{ $animClass }}"
        style="gap: var(--marquee-gap); --marquee-duration: {{ $duration }}; --marquee-direction: {{ $animDirection }};"
    >
        {{ $slot }}
    </div>
    
    <div
        aria-hidden="true"
        class="flex shrink-0 justify-around {{ $flexClass }} {{ $animClass }}"
        style="gap: var(--marquee-gap); --marquee-duration: {{ $duration }}; --marquee-direction: {{ $animDirection }};"
    >
        {{ $slot }}
    </div>
</div>