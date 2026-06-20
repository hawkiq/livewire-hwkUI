<div 
    x-data="{ activeTab: '{{ $default }}' }" 
    {{ $attributes->class(['hwkui-tabs w-full']) }}
>
    {{ $slot }}
</div>