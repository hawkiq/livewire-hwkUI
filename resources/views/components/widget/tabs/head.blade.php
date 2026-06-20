@aware(['color' => 'primary', 'variant' => 'classic'])

@php
    $safeVariant = in_array($variant, ['pills', 'classic']) ? $variant : 'classic';
    // Map active classes for the "pills" variant
    $solidColors = [
        'primary' => 'bg-blue-600 text-white border-blue-700 dark:bg-blue-500 dark:border-blue-600',
        'secondary' => 'bg-slate-600 text-white border-slate-700 dark:bg-slate-500 dark:border-slate-600',
        'success' => 'bg-emerald-600 text-white border-emerald-700 dark:bg-emerald-500 dark:border-emerald-600',
        'danger' => 'bg-red-600 text-white border-red-700 dark:bg-red-500 dark:border-red-600',
        'warning' => 'bg-amber-500 text-white border-amber-600 dark:bg-amber-500 dark:border-amber-600',
        'info' => 'bg-sky-600 text-white border-sky-700 dark:bg-sky-500 dark:border-sky-600',
        'violet' => 'bg-violet-600 text-white border-violet-700 dark:bg-violet-500 dark:border-violet-600',
        'pink' => 'bg-pink-600 text-white border-pink-700 dark:bg-pink-500 dark:border-pink-600',
        'dark' => 'bg-slate-900 text-white border-slate-950 dark:bg-slate-800 dark:border-slate-700',
        'light' =>
            'bg-slate-100 text-slate-800 border-slate-200 dark:bg-slate-700 dark:text-slate-100 dark:border-slate-600',
    ];

    // Map active classes for the "classic" (underline) variant
    $classicColors = [
        'primary' => 'border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-500',
        'secondary' => 'border-slate-600 text-slate-600 dark:border-slate-500 dark:text-slate-500',
        'success' => 'border-emerald-600 text-emerald-600 dark:border-emerald-500 dark:text-emerald-500',
        'danger' => 'border-red-600 text-red-600 dark:border-red-500 dark:text-red-500',
        'warning' => 'border-amber-500 text-amber-500 dark:border-amber-500 dark:text-amber-500',
        'info' => 'border-sky-600 text-sky-600 dark:border-sky-500 dark:text-sky-500',
        'violet' => 'border-violet-600 text-violet-600 dark:border-violet-500 dark:text-violet-500',
        'pink' => 'border-pink-600 text-pink-600 dark:border-pink-500 dark:text-pink-500',
        'dark' => 'border-slate-900 text-slate-900 dark:border-slate-100 dark:text-slate-100',
        'light' => 'border-slate-200 text-slate-800 dark:border-slate-600 dark:text-slate-200',
    ];

    $activePill = $solidColors[$color] ?? $solidColors['primary'];
    $activeClassic = $classicColors[$color] ?? $classicColors['primary'];
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
