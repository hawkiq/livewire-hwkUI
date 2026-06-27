<div {{ $attributes->merge([
    'class' => 'flex items-start gap-3 px-4 py-2 rounded-lg border-l-5 border shadow-md my-2 mx-1 ' . $getColorClasses()
]) }} role="alert">
    
    @if($icon !== 'false')
        <div class="shrink-0 mt-0.5">
            @php
                $defaultIcons = [
                    'primary' => 'info-circle', 'info' => 'info-circle',
                    'success' => 'check-circle', 'danger' => 'exclamation-circle',
                    'warning' => 'exclamation-triangle', 'secondary' => 'bell'
                ];
                $resolvedIcon = $icon ?? ($defaultIcons[$color] ?? 'info-circle');
                
                $animationClass = $animated ? 'fa-bounce' : '';
            @endphp

            <x-hwkui-icon :name="$resolvedIcon" class="text-lg opacity-90 {{ $animationClass }}" />
        </div>
    @endif

    {{-- Alert Content --}}
    <div class="flex-1 text-sm font-medium leading-relaxed">
        {{ $slot }}
    </div>
</div>