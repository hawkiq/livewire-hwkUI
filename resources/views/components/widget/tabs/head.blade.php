@aware(['color' => 'primary', 'variant' => 'classic'])

@php
    $safeVariant = in_array($variant, ['pills', 'classic']) ? $variant : 'classic';
    $activePill = \Hawkiq\Hwkui\Support\Color::classes($color, 'solid');
    $activeClassic = \Hawkiq\Hwkui\Support\Color::classes($color, 'outline');
@endphp

<button @click="activeTab = '{{ $name }}'"
    :class="{
        /* PILLS VARIANT */
        '{{ $activePill }} shadow-md scale-105': '{{ $safeVariant }}'
        === 'pills' && activeTab === '{{ $name }}',
        'hover:bg-slate-100 text-slate-500 hover:text-slate-900 dark:hover:bg-slate-800 dark:text-slate-400 dark:hover:text-slate-200': '{{ $safeVariant }}'
        === 'pills' && activeTab !== '{{ $name }}',
    
        /* CLASSIC VARIANT */
        '{{ $activeClassic }} border-b-2': '{{ $safeVariant }}'
        === 'classic' && activeTab === '{{ $name }}',
        'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 border-b-2 dark:text-slate-400 dark:hover:text-slate-300 dark:hover:border-slate-600': '{{ $safeVariant }}'
        === 'classic' && activeTab !== '{{ $name }}',
    }"
    class="shrink-0 whitespace-nowrap cursor-pointer relative flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold rounded-xl transition-all duration-300 ease-out focus:outline-none group"
    {{ $attributes }}>
    @if ($icon)
        <span class="transition-transform duration-300 group-hover:scale-110"
            :class="activeTab === '{{ $name }}' ? 'opacity-100' : 'opacity-70'">
            <x-hwkui-icon :name="$icon" />
        </span>
    @endif

    <span class="relative z-10">{{ $slot }}</span>

    @if ($badge)
        <span class="ml-1 transition-opacity duration-300"
            :class="activeTab === '{{ $name }}' ? 'opacity-100' : 'opacity-80'">
            <x-hwkui-badge variant="solid" :color="$badgeColor" size="sm">
                {{ $badge }}
            </x-hwkui-badge>
        </span>
    @endif
</button>
