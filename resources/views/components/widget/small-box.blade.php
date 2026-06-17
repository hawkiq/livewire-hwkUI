<div {{ $attributes->merge(['class' => $boxClasses()]) }}>

    @if ($loading)
        <div class="absolute inset-0 bg-white/70 flex items-center justify-center z-10">
            <x-hwkui-icon name="circle-notch" class="fa-spin text-2xl text-gray-600" />
        </div>
    @endif

    <div class="relative z-10">
        @if ($title)
            <div class="text-3xl font-bold leading-tight">{{ $title }}</div>
        @endif

        @if ($text)
            <div class="text-sm mt-1">{{ $text }}</div>
        @endif
    </div>

    @if ($url && $urlText)
        <div class="relative z-10 mt-4 border-t border-white/20 pt-2 text-sm">
            <a href="{{ $url }}" class="flex items-center space-x-1" target="_blank">
                <span>{{ $urlText }}</span>
                @if ($urlIcon)
                <x-hwkui-icon name="{{ $urlIcon }}" />
                @endif
            </a>
        </div>
    @endif

    @if ($icon)
        <div class="absolute top-2 right-2 text-7xl opacity-20 z-0 pointer-events-none">
            <x-hwkui-icon name="{{ $icon }}" />
        </div>
    @endif
</div>
