<div x-data="{
    currentIndex: 0,
    interval: {{ $interval }},
    count: {{ $items }},
    autoplay: null,
    breakpoints: {{ Js::from($breakpoints) }},
    itemsPerView: 1,

    init() {
        this.updateItemsPerView();
        window.addEventListener('resize', () => this.updateItemsPerView());
        this.start();
    },
    updateItemsPerView() {
        let width = window.innerWidth;
        if (width >= 1024 && this.breakpoints.lg) this.itemsPerView = this.breakpoints.lg;
        else if (width >= 768 && this.breakpoints.md) this.itemsPerView = this.breakpoints.md;
        else if (width >= 640 && this.breakpoints.sm) this.itemsPerView = this.breakpoints.sm;
        else this.itemsPerView = this.breakpoints.default || 1;

        if (this.currentIndex > this.maxIndex()) this.currentIndex = this.maxIndex();
    },
    maxIndex() {
        return Math.max(0, this.count - this.itemsPerView);
    },
    start() {
        this.stop();
        if (this.interval > 0) this.autoplay = setInterval(() => { this.nextSlide() }, this.interval);
    },
    stop() {
        if (this.autoplay) clearInterval(this.autoplay);
    },
    nextSlide() {
        this.currentIndex = this.currentIndex < this.maxIndex() ? this.currentIndex + 1 : 0;
    },
    prevSlide() {
        this.currentIndex = this.currentIndex > 0 ? this.currentIndex - 1 : this.maxIndex();
    },
    goToSlide(index) {
        if (index <= this.maxIndex()) this.currentIndex = index;
    }
}" :style="`--items-per-view: ${itemsPerView}; --current-index: ${currentIndex};`"
    {{ $attributes->merge(['class' => 'relative w-full rounded-2xl p-5 overflow-hidden']) }}>

    {{-- relative w-full overflow-hidden --}}
    <section class="relative w-full h-full overflow-hidden" @mouseenter="stop()"
        @mouseleave="start()">

        {{-- Track --}}
        <div class="flex h-full transition-[margin] duration-500 ease-out"
            :style="`
                                            width: ${count * (100 / itemsPerView)}%;
                                            margin-inline-start: -${currentIndex * (100 / itemsPerView)}%;
                                        `">
            {{ $slot }}
        </div>

        {{-- Controls --}}
        @if ($showControls)
            <button @click="prevSlide()"
                class="cursor-pointer absolute left-4 lg:left-8 rtl:left-auto rtl:right-4 lg:rtl:right-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 border border-white/20 text-white backdrop-blur-sm flex items-center justify-center transition-all duration-200 hover:scale-110">
                <x-hwkui-icon name="chevron-left" class="rtl:rotate-180" />
            </button>
            <button @click="nextSlide()"
                class="cursor-pointer absolute right-4 lg:right-8 rtl:right-auto rtl:left-4 lg:rtl:left-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 border border-white/20 text-white backdrop-blur-sm flex items-center justify-center transition-all duration-200 hover:scale-110">
                <x-hwkui-icon name="chevron-right" class="rtl:rotate-180" />
            </button>
        @endif

        @if ($showIndicators)
        {{-- Indicators --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
            <template x-for="i in (maxIndex() + 1)" :key="i">
                <button @click="goToSlide(i - 1)" class="cursor-pointer transition-all duration-300 rounded-full"
                    :class="currentIndex === (i - 1) ? 'w-8 h-2 bg-blue-400' : 'w-2 h-2 bg-white/40 hover:bg-white/70'">
                </button>
            </template>
        </div>
        @endif

        @if ($showCount)
            {{-- Slide count showing range --}}
            <div
                class="absolute top-24 right-6 lg:right-10 rtl:right-auto rtl:left-6 lg:rtl:left-10 z-20 text-white/50 text-xs font-mono tracking-widest">
                <span x-text="currentIndex + 1" class="text-white font-bold text-sm"></span>
                <span class="mx-1">-</span>
                <span x-text="Math.min(currentIndex + itemsPerView, count)" class="text-white font-bold text-sm"></span>
                <span class="mx-1">/</span>
                <span x-text="count"></span>
            </div>
        @endif
    </section>
</div>