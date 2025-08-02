<div {{ $attributes->merge(['class' => $cardClasses()]) }}>

    @if ($title || $icon)
        <div class="{{ $headerClasses() }}">
            <div class="flex items-center gap-2">
                @if ($icon)
                    <i class="{{ $icon }}"></i>
                @endif
                @if ($title)
                    <span>{{ $title }}</span>
                @endif
            </div>

            @isset($tools)
                <div class="flex gap-2 items-center">
                    {{ $tools }}
                </div>
            @endisset
        </div>
    @endif

    <div class="{{ $bodyClasses() }}">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="{{ $footerClasses() }}">
            {{ $footer }}
        </div>
    @endisset

    @if ($disabled)
        <div class="absolute inset-0 bg-white/70 flex items-center justify-center z-10">
            <i class="fas fa-ban text-gray-400 text-3xl"></i>
        </div>
    @endif
</div>
