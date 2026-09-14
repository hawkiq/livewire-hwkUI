@aware(['color' => 'primary', 'animation' => 'slide', 'expanded' => false])

@php
    $activeThemeClasses = \Hawkiq\Hwkui\Support\Color::classes($color, 'solid');
    $borderThemeClasses = \Hawkiq\Hwkui\Support\Color::classes($color, 'border');
@endphp

<div x-data="{
    id: Math.random().toString(36).substring(2, 9),
    localExpanded: {{ $expanded ? 'true' : 'false' }},
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
