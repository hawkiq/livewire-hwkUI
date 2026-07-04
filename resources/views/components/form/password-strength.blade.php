@php
    $activeRules = collect($rules)->filter(fn($value) => $value !== false)->toArray();
@endphp

<div x-data="passwordStrength('{{ $name }}', @js($activeRules))" class="mt-3 w-full">

    <div class="h-1.5 w-full bg-gray-200 rounded-full overflow-hidden flex dark:bg-gray-700">
        <div class="h-full transition-all duration-300" :class="barColor" :style="`width: ${ percentage }%`"></div>
    </div>
    
    <div class="mt-1 flex justify-end text-xs font-medium" :class="textColor" x-cloak>
        <span x-text="strengthText"></span>
    </div>

    @if($checklist && count($activeRules) > 0)
    <ul class="mt-3 space-y-1.5 text-sm text-gray-500 dark:text-gray-400">
        @if(isset($activeRules['length']))
            <li class="flex items-center gap-2" :class="checklist.length ? 'text-green-600 dark:text-green-400' : ''">
                <x-hwkui-icon name="check" x-show="checklist.length" class="w-4 h-4" x-cloak />
                <x-hwkui-icon name="circle" type="r" x-show="!checklist.length" class="w-4 h-4 text-gray-300" />
                {{ __('At least :count characters', ['count' => $activeRules['length']]) }}
            </li>
        @endif
        
        @if(isset($activeRules['uppercase']))
            <li class="flex items-center gap-2" :class="checklist.uppercase ? 'text-green-600 dark:text-green-400' : ''">
                <x-hwkui-icon name="check" x-show="checklist.uppercase" class="w-4 h-4" x-cloak />
                <x-hwkui-icon name="circle" type="r" x-show="!checklist.uppercase" class="w-4 h-4 text-gray-300" />
                {{ __('One uppercase letter') }}
            </li>
        @endif

        @if(isset($activeRules['lowercase']))
            <li class="flex items-center gap-2" :class="checklist.lowercase ? 'text-green-600 dark:text-green-400' : ''">
                <x-hwkui-icon name="check" x-show="checklist.lowercase" class="w-4 h-4" x-cloak />
                <x-hwkui-icon name="circle" type="r" x-show="!checklist.lowercase" class="w-4 h-4 text-gray-300" />
                {{ __('One lowercase letter') }}
            </li>
        @endif

        @if(isset($activeRules['number']))
            <li class="flex items-center gap-2" :class="checklist.number ? 'text-green-600 dark:text-green-400' : ''">
                <x-hwkui-icon name="check" x-show="checklist.number" class="w-4 h-4" x-cloak />
                <x-hwkui-icon name="circle" type="r" x-show="!checklist.number" class="w-4 h-4 text-gray-300" />
                {{ __('One number') }}
            </li>
        @endif

        @if(isset($activeRules['symbol']))
            <li class="flex items-center gap-2" :class="checklist.symbol ? 'text-green-600 dark:text-green-400' : ''">
                <x-hwkui-icon name="check" x-show="checklist.symbol" class="w-4 h-4" x-cloak />
                <x-hwkui-icon name="circle" type="r" x-show="!checklist.symbol" class="w-4 h-4 text-gray-300" />
                {{ __('One special character') }}
            </li>
        @endif
    </ul>
    @endif
</div>

@once
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('passwordStrength', (targetName, rulesConfig) => ({
            password: '',
            score: 0,
            maxScore: Object.keys(rulesConfig).length,
            checklist: {},
            labels: {
                weak: @js(__('Weak')),
                good: @js(__('Good')),
                strong: @js(__('Strong'))
            },
            
            init() {
                Object.keys(rulesConfig).forEach(key => this.checklist[key] = false);

                this.$nextTick(() => {
                    const input = document.querySelector(`input[name="${targetName}"], input[wire\\:model="${targetName}"]`);
                    if (input) {
                        this.password = input.value;
                        this.evaluate();
                        
                        input.addEventListener('input', (e) => {
                            this.password = e.target.value;
                            this.evaluate();
                        });
                    }
                });
            },
            
            evaluate() {
                if (!this.password) {
                    this.score = 0;
                    Object.keys(this.checklist).forEach(key => this.checklist[key] = false);
                    return;
                }

                if ('length' in rulesConfig) this.checklist.length = this.password.length >= rulesConfig.length;
                if ('uppercase' in rulesConfig) this.checklist.uppercase = /[A-Z]/.test(this.password);
                if ('lowercase' in rulesConfig) this.checklist.lowercase = /[a-z]/.test(this.password);
                if ('number' in rulesConfig) this.checklist.number = /[0-9]/.test(this.password);
                if ('symbol' in rulesConfig) this.checklist.symbol = /[^A-Za-z0-9]/.test(this.password);

                this.score = Object.values(this.checklist).filter(Boolean).length;
            },

            get percentage() {
                if (this.maxScore === 0) return 0;
                return (this.score / this.maxScore) * 100;
            },
            
            get barColor() {
                if (this.score === 0) return 'bg-transparent';
                if (this.percentage <= 34) return 'bg-red-500';
                if (this.percentage <= 75) return 'bg-amber-500';
                return 'bg-green-500';
            },
            
            get textColor() {
                if (this.score === 0) return 'text-transparent';
                if (this.percentage <= 34) return 'text-red-600 dark:text-red-400';
                if (this.percentage <= 75) return 'text-amber-600 dark:text-amber-400';
                return 'text-green-600 dark:text-green-400';
            },
            
            get strengthText() {
                if (this.score === 0) return '';
                if (this.percentage <= 34) return this.labels.weak;
                if (this.percentage <= 75) return this.labels.good;
                return this.labels.strong;
            }
        }));
    });
</script>
@endonce