@props([
    'items',
    'interval' => 5000
])

<div x-data="{
    heroIndex: 0,
    interval: {{ $interval }},
    count: {{ $items->count() }},
    autoplay: null,
    init() { 
        this.start(); 
    },
    start() { 
        this.autoplay = setInterval(() => { this.nextSlide() }, this.interval);
    },
    stop() { 
        clearInterval(this.autoplay);
    },
    nextSlide() {
        this.heroIndex = (this.heroIndex + 1) % this.count;
    },
    prevSlide() {
        this.heroIndex = (this.heroIndex - 1 + this.count) % this.count;
    },
    goToSlide(index) {
        this.heroIndex = index;
    }
}" 
class="relative rounded-2xl min-h-screen bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100">

    <section class="relative h-screen min-h-150 max-h-225 overflow-hidden" 
        @mouseenter="stop()"
        @mouseleave="start()">
        
        {{ $slot }}

        {{-- Carousel Controls --}}
        <button @click="prevSlide()"
            class="cursor-pointer absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 border border-white/20 text-white backdrop-blur-sm flex items-center justify-center transition-all duration-200 hover:scale-110">
            <x-hwkui-icon name="chevron-left" />
        </button>
        <button @click="nextSlide()"
            class="cursor-pointer absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 rounded-full bg-white/10 hover:bg-white/25 border border-white/20 text-white backdrop-blur-sm flex items-center justify-center transition-all duration-200 hover:scale-110">
            <x-hwkui-icon name="chevron-right" />
        </button>

        {{-- Dot indicators --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
            @foreach ($items as $i => $d)
                <button @click="goToSlide({{ $i }})" class="cursor-pointer transition-all duration-300 rounded-full"
                    :class="heroIndex === {{ $i }} ? 'w-8 h-2 bg-blue-400' : 'w-2 h-2 bg-white/40 hover:bg-white/70'">
                </button>
            @endforeach
        </div>

        {{-- Slide count --}}
        <div class="absolute top-24 right-6 lg:right-10 z-20 text-white/50 text-xs font-mono tracking-widest">
            <span x-text="heroIndex + 1" class="text-white font-bold text-sm"></span>
            <span class="mx-1">/</span>
            {{ $items->count() }}
        </div>

    </section>
</div>