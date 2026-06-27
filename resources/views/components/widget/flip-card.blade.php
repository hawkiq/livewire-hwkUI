<div
    x-data="{ 
        flipped: false, 
        trigger: '{{ $trigger }}' 
    }"
    
    x-on:click="if(trigger === 'click') flipped = !flipped"
    x-on:mouseenter="if(trigger === 'hover') flipped = true"
    x-on:mouseleave="if(trigger === 'hover') flipped = false"
    
    style="height: {{ $height }};"
    {{ $attributes->merge(['class' => 'relative w-full [perspective:1000px] bg-transparent cursor-pointer group']) }}
>
    <div
        class="w-full h-full relative transition-transform duration-700 transform-3d"
        x-bind:class="flipped ? 'transform-[rotateY(180deg)]' : ''"
    >
        <div class="absolute inset-0 w-full h-full backface-hidden bg-white border rounded-xl overflow-hidden shadow-sm flex flex-col">
            {{ $front ?? $slot }}
        </div>

        <div class="absolute inset-0 w-full h-full backface-hidden transform-[rotateY(180deg)] bg-white border rounded-xl overflow-hidden shadow-sm flex flex-col">
            {{ $back }}
        </div>
    </div>
</div>