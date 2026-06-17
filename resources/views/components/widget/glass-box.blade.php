<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => $cardClasses()]) }}
    wire:navigate
>
{{-- glass shine --}}
<div class="
    pointer-events-none
    absolute
    inset-0
    bg-linear-to-br
    from-white/20
    via-white/5
    to-transparent
"></div>

    {{-- top decoration --}}
    <div class="absolute inset-x-0 top-0 h-1 {{ $badgeClasses() }}"></div>

    <div class="flex items-start justify-between">

        <div class="space-y-3">

            <p class="text-sm font-medium">
                {{ $title }}
            </p>

            <h2 class="text-3xl font-bold tracking-tight ">
                {{ $formattedValue() }}
            </h2>

        </div>

        <div class="{{ $iconClasses() }}">
            <x-hwkui-icon name="{{ $icon }}" class="text-xl" />
        </div>

    </div>
</a>