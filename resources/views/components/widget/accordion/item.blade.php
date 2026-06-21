@aware(['color' => 'primary', 'animation' => 'slide'])

@php
    $activeThemeClasses = match ($color) {
        'success' => 'bg-green-500 text-white dark:bg-green-600',
        'warning' => 'bg-yellow-400 text-yellow-900 dark:bg-yellow-500',
        'danger' => 'bg-red-500 text-white dark:bg-red-600',
        'info' => 'bg-cyan-500 text-white dark:bg-cyan-600',
        'pink' => 'bg-pink-500 text-white dark:bg-pink-600',
        'violet' => 'bg-violet-500 text-white dark:bg-violet-600',
        'dark' => 'bg-gray-800 text-white dark:bg-gray-900',
        'secondary' => 'bg-gray-500 text-white dark:bg-gray-600',
        default => 'bg-blue-500 text-white dark:bg-blue-600', // primary
    };

    $borderThemeClasses = match ($color) {
        'success' => 'border-green-500 dark:border-green-600',
        'warning' => 'border-yellow-400 dark:border-yellow-500',
        'danger' => 'border-red-500 dark:border-red-600',
        'info' => 'border-cyan-500 dark:border-cyan-600',
        'pink' => 'border-pink-500 dark:border-pink-600',
        'violet' => 'border-violet-500 dark:border-violet-600',
        'dark' => 'border-gray-800 dark:border-gray-900',
        'secondary' => 'border-gray-500 dark:border-gray-600',
        default => 'border-blue-500 dark:border-blue-600',
    };
@endphp

<div x-data="{
    id: Math.random().toString(36).substring(2, 9),
    localExpanded: false,
    get isExpanded() {
        return this.collapse ? this.activeItem === this.id : this.localExpanded;
    },
    toggle() {
        if ({{ $disabled ? 'true' : 'false' }}) return;

        if (this.collapse) {
            this.activeItem = this.isExpanded ? null : this.id;
        } else {
            this.localExpanded = !this.localExpanded;
        }
    }
}" {{ $attributes }}>

    <button type="button" @click="toggle()" :aria-expanded="isExpanded"
        class="cursor-pointer flex items-center justify-between w-full p-4 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-50 transition-colors duration-300 ease-in-out"
        :class="{
            '{{ $activeThemeClasses }}': isExpanded,
            'bg-transparent text-gray-900 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-900': !isExpanded && !
                {{ $disabled ? 'true' : 'false' }},
            'text-gray-400 bg-transparent cursor-not-allowed opacity-60': {{ $disabled ? 'true' : 'false' }}
        }"
        @if ($disabled) disabled @endif>

        <span class="flex items-center gap-2 font-medium">
            {{ $heading }}
        </span>
        <span class="transform transition-transform duration-300 ease-in-out"
            :class="isExpanded && '{{ $icon }}'
            === 'chevron-down' ? 'fa-rotate-180' : ''">
            <x-hwkui-icon :name="$icon" class="w-5 h-5" />
        </span>
    </button>

    {{-- Update the content container class logic --}}
    @if ($animation === 'slide')
        <div x-ref="container" :style="isExpanded ? `max-height: ${$refs.container.scrollHeight}px` : 'max-height: 0px'"
            class="overflow-hidden bg-transparent transition-all duration-300 ease-in-out"
            :class="isExpanded ? 'border-opacity-100 border-x border-b {{ $borderThemeClasses }}' : 'border-opacity-0'">
            <div class="p-4 text-gray-600 dark:text-gray-300 prose prose-sm max-w-none">
                {{ $slot }}
            </div>
        </div>
    @elseif ($animation === 'fade')
        <div x-show="isExpanded" x-transition.opacity.duration.300ms style="display: none;"
            class="overflow-hidden bg-transparent"
            :class="isExpanded ? 'border-opacity-100 border-x border-b {{ $borderThemeClasses }}' : 'border-opacity-0'">
            <div class="p-4 text-gray-600 dark:text-gray-300 prose prose-sm max-w-none">
                {{ $slot }}
            </div>
        </div>
    @else
        <div x-show="isExpanded" style="display: none;" class="overflow-hidden bg-transparent"
            :class="isExpanded ? 'border-opacity-100 border-x border-b {{ $borderThemeClasses }}' : 'border-opacity-0'">
            <div class="p-4 text-gray-600 dark:text-gray-300 prose prose-sm max-w-none">
                {{ $slot }}
            </div>
        </div>
    @endif
</div>
