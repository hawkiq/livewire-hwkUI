<div
    x-data="onboardingTour(@js($steps), @js($open))"
    @keydown.escape.window="end()"
    @resize.window.debounce.10ms="updatePosition()"
    @scroll.window.debounce.10ms="updatePosition()"
    {{ $attributes->merge(['class' => 'block']) }}
>
    {{ $slot }}

    <template x-teleport="body">
        <div 
            x-show="active" 
            class="fixed inset-0 z-9999" 
            style="display: none;"
        >
            <div class="absolute inset-0 overflow-hidden pointer-events-auto">
                <div 
                    x-show="hasTarget"
                    class="absolute transition-all duration-300 ease-in-out bg-transparent rounded-lg shadow-[0_0_0_9999px_rgba(0,0,0,0.6)]"
                    :style="spotlightStyle"
                ></div>
                
                <div 
                    x-show="!hasTarget" 
                    class="absolute inset-0 bg-black/60 transition-opacity duration-300"
                ></div>
            </div>

            <div 
                x-ref="popover"
                class="absolute z-50 w-80 bg-white dark:bg-gray-900 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-800 pointer-events-auto transition-all duration-300 ease-in-out p-4 flex flex-col"
                :style="popoverStyle"
            >
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold tracking-wide text-gray-500 dark:text-gray-400">
                        <span x-text="currentIndex + 1"></span> OF <span x-text="steps.length"></span>
                    </span>
                    <button @click="end()" class="cursor-pointer text-gray-400 transition-colors hover:text-gray-600 dark:hover:text-gray-300 outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded-sm">
                        <x-hwkui-icon name="xmark" class="w-4 h-4" />
                    </button>
                </div>

                <h3 class="text-base font-semibold text-gray-900 dark:text-white" x-text="currentStep.title"></h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300 leading-relaxed" x-text="currentStep.body"></p>

                <div class="flex items-center justify-between mt-6">
                    <button @click="end()" class="cursor-pointer text-sm font-medium text-gray-500 transition-colors hover:text-gray-700 dark:hover:text-gray-300 outline-none rounded-sm focus-visible:ring-2 focus-visible:ring-blue-500">
                        Skip
                    </button>
                    
                    <div class="flex items-center gap-2">
                        <button 
                            x-show="currentIndex > 0" 
                            @click="back()" 
                            class="cursor-pointer inline-flex items-center justify-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 transition-colors outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                        >
                            <x-hwkui-icon name="chevron-left" class="w-4 h-4" /> Back
                        </button>
                        
                        <button 
                            @click="next()" 
                            class="cursor-pointer inline-flex items-center justify-center gap-1.5 px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors shadow-sm outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-900"
                        >
                            <span x-text="isLast ? 'Done' : 'Next'"></span>
                            <template x-if="!isLast">
                                <x-hwkui-icon name="chevron-right" class="w-4 h-4" />
                            </template>
                            <template x-if="isLast">
                                <x-hwkui-icon name="check" class="w-4 h-4" />
                            </template>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

@once
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('onboardingTour', (steps, startOpen) => ({
            steps: steps || [],
            active: startOpen,
            currentIndex: 0,
            hasTarget: false,
            spotlightStyle: '',
            popoverStyle: '',
            padding: 8,

            get currentStep() {
                return this.steps[this.currentIndex] || {};
            },

            get isLast() {
                return this.currentIndex === this.steps.length - 1;
            },

            init() {
                if (this.active) {
                    this.$nextTick(() => this.update());
                }
                this.$watch('active', val => {
                    if (val) this.$nextTick(() => this.update());
                });
            },

            start() {
                this.currentIndex = 0;
                this.active = true;
            },

            end() {
                this.active = false;
            },

            next() {
                if (this.isLast) {
                    this.end();
                } else {
                    this.currentIndex++;
                    this.update();
                }
            },

            back() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                    this.update();
                }
            },

            update() {
                if (!this.active || !this.steps.length) return;

                const targetEl = document.querySelector(this.currentStep.target);

                if (targetEl) {
                    this.hasTarget = true;
                    targetEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    setTimeout(() => {
                        this.updatePosition(targetEl);
                    }, 300);
                } else {
                    this.hasTarget = false;
                    this.positionPopoverCenter();
                }
            },

            updatePosition(el = null) {
                if (!this.active || !this.hasTarget) return;
                
                const targetEl = el instanceof HTMLElement ? el : document.querySelector(this.currentStep.target);
                if (!targetEl) return;

                const rect = targetEl.getBoundingClientRect();
                
                this.spotlightStyle = `
                    top: ${rect.top - this.padding}px;
                    left: ${rect.left - this.padding}px;
                    width: ${rect.width + (this.padding * 2)}px;
                    height: ${rect.height + (this.padding * 2)}px;
                `;

                this.positionPopover(rect, this.currentStep.placement || 'bottom');
            },

            positionPopover(targetRect, placement) {
                const popover = this.$refs.popover;
                if (!popover) return;
                
                const popRect = popover.getBoundingClientRect();
                const offset = 16; // Space between spotlight border and popover card
                let top = 0;
                let left = 0;

                switch (placement) {
                    case 'top':
                        top = targetRect.top - this.padding - popRect.height - offset;
                        left = targetRect.left + (targetRect.width / 2) - (popRect.width / 2);
                        break;
                    case 'bottom':
                        top = targetRect.bottom + this.padding + offset;
                        left = targetRect.left + (targetRect.width / 2) - (popRect.width / 2);
                        break;
                    case 'left':
                        top = targetRect.top + (targetRect.height / 2) - (popRect.height / 2);
                        left = targetRect.left - this.padding - popRect.width - offset;
                        break;
                    case 'right':
                        top = targetRect.top + (targetRect.height / 2) - (popRect.height / 2);
                        left = targetRect.right + this.padding + offset;
                        break;
                }

                const margin = 16;
                left = Math.max(margin, Math.min(left, window.innerWidth - popRect.width - margin));
                top = Math.max(margin, Math.min(top, window.innerHeight - popRect.height - margin));

                this.popoverStyle = `top: ${top}px; left: ${left}px;`;
            },

            positionPopoverCenter() {
                const popover = this.$refs.popover;
                if (!popover) return;
                
                const popRect = popover.getBoundingClientRect();
                const top = (window.innerHeight / 2) - (popRect.height / 2);
                const left = (window.innerWidth / 2) - (popRect.width / 2);
                
                this.popoverStyle = `top: ${top}px; left: ${left}px;`;
            }
        }));
    });
</script>
@endonce