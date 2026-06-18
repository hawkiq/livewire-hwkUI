<span {{ $attributes->merge(['class' => $getShapeClasses() . ' ' . $getColorClasses()]) }}>
    @if($icon)
        <x-hwkui-icon name="{{ $icon }}" class="{{ $getIconSizeClass() }}" />
    @endif
    
    <span>{{ $slot }}</span>
</span>