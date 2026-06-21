<div x-data="{ 
        activeItem: null, 
        collapse: {{ $collapse ? 'true' : 'false' }}
    }"
    {{ $attributes->merge(['class' => 'w-full rounded-lg border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800 shadow-sm overflow-hidden']) }}>
    {{ $slot }}
</div>