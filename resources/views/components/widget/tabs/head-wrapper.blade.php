@aware(['variant' => 'classic'])

@php
    $safeVariant = in_array($variant, ['pills', 'classic']) ? $variant : 'classic';
    
    // Determine the gradient color based on the variant so the fade blends perfectly
    $fadeLeftPills = 'bg-gradient-to-r from-slate-50 to-transparent dark:from-slate-900';
    $fadeRightPills = 'bg-gradient-to-l from-slate-50 to-transparent dark:from-slate-900';
    
    $fadeLeftClassic = 'bg-gradient-to-r from-white to-transparent dark:from-slate-950';
    $fadeRightClassic = 'bg-gradient-to-l from-white to-transparent dark:from-slate-950';
@endphp

<div 
    x-data="{ 
        scrolledToStart: true,
        scrolledToEnd: false,
        checkScroll() {
            const el = this.$refs.tabContainer;
            this.scrolledToStart = el.scrollLeft <= 0;
            // Math.ceil helps prevent sub-pixel calculation bugs on zoomed/high-res screens
            this.scrolledToEnd = Math.ceil(el.scrollLeft + el.clientWidth) >= el.scrollWidth - 1;
        }
    }"
    x-init="
        // Check on load
        $nextTick(() => checkScroll());
        // Re-check if the window resizes
        window.addEventListener('resize', () => checkScroll());
    "
    {{ $attributes->class([
        'relative w-full overflow-hidden',
        /* PILLS Base container styles */
        'bg-slate-50 border border-slate-200 rounded-2xl dark:bg-slate-900 dark:border-slate-800 p-1' => $safeVariant === 'pills',
    ]) }}
>
    <div 
        x-show="!scrolledToStart" 
        x-transition.opacity.duration.300ms
        class="absolute left-0 top-0 bottom-0 w-8 z-10 pointer-events-none rounded-l-xl {{ $safeVariant === 'pills' ? $fadeLeftPills : $fadeLeftClassic }}"
    ></div>

    <div 
        x-ref="tabContainer"
        @scroll.passive="checkScroll"
        class="flex items-center overflow-x-auto scroll-smooth [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-none] {{ $safeVariant === 'pills' ? 'space-x-1' : 'border-b border-slate-200 dark:border-slate-800 space-x-6 w-full' }}"
    >
        {{ $slot }}
    </div>

    <div 
        x-show="!scrolledToEnd" 
        x-transition.opacity.duration.300ms
        class="absolute right-0 top-0 bottom-0 w-12 z-10 pointer-events-none rounded-r-xl {{ $safeVariant === 'pills' ? $fadeRightPills : $fadeRightClassic }}"
    ></div>
</div>