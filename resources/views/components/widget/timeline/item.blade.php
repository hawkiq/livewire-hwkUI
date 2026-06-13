@php
    $horizontal = $direction === 'horizontal';
@endphp

<div 
    {{ 
        $attributes->class([
            'hwkui-timeline-item flex gap-2',
            'items-start' => !$horizontal,
            'flex-col items-center text-center min-w-[100px] gap-1' => $horizontal
        ]) 
    }}
>
    {{ $slot }}
</div>