<div {{ $attributes->merge(['class' => $boxClasses()]) }}>
    <div class="{{ $iconClasses() }}">
        @if ($icon)
            <i class="{{ $icon }}"></i>
        @endif
    </div>

    <div class="flex-1 ml-4">
        @if ($url)
            <a href="{{ $url }}" target="{{ $urlTarget }}" class="block font-bold text-sm hover:underline">
                {{ $title }}
            </a>
        @else
            <div class="font-bold text-sm">{{ $title }}</div>
        @endif

        @if ($text)
            <div class="text-2xl font-extrabold mt-1">{{ $text }}</div>
        @endif

        @if ($description)
            <div class="text-sm text-gray-700 dark:text-gray-300 mt-1">{{ $description }}</div>
        @endif

        @if ($progress !== null)
            <div class="mt-2">
                <div class="w-full h-1 bg-gray-300 rounded">
                    <div class="h-1 rounded {{ $progressBarClasses() }}" style="width: {{ $progress }}%;"></div>
                </div>
            </div>
        @endif
    </div>
</div>
