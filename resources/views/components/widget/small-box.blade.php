<div {{ $attributes->merge(['class' => $boxClasses()]) }}>

    @if ($loading)
        <div class="absolute inset-0 bg-white/70 flex items-center justify-center z-10">
            <svg class="animate-spin h-8 w-8 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                </path>
            </svg>
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
                    <i class="{{ $urlIcon }}"></i>
                @endif
            </a>
        </div>
    @endif

    @if ($icon)
        <div class="absolute top-2 right-2 text-7xl opacity-20 z-0 pointer-events-none">
            <i class="{{ $icon }}"></i>
        </div>
    @endif
</div>
