<div 
    x-show="activeTab === '{{ $name }}'" 
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    class="hwkui-tabs-content w-full py-4"
    {{ $attributes }}
>
    {{ $slot }}
</div>