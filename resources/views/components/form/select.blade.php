@props([
    'label' => null,
])
@php
    $hasLabel = filled($label);
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('Jquery');
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('Select2');
@endphp

<div {{ $attributes->except('class', 'style')->merge(['class' => 'w-full'])->only('style') }}>
    @if ($hasLabel)
        <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <select {{ $attributes->merge(['class' => 'select2 block w-full']) }} style="{{ $attributes->get('style') ?? '' }};">
        {{ $slot }}
    </select>
</div>

@once
    @assets
        @include('hwkui::plugins', ['type' => 'css'])
        @include('hwkui::plugins', ['type' => 'js'])
    @endassets
@endonce

@script
    @script
        <script>
            if (!window.HwkSelect2Booted) {

                window.HwkSelect2Booted = true;

                window.HwkSelect2 = {

                    init(scope = document) {
                        const targets = scope.classList?.contains('select2') ?
                            [scope] :
                            scope.querySelectorAll('.select2');
                        targets.forEach(el => {

                            const currentValue = $(el).val();

                            if ($(el).data('select2')) {
                                $(el).off('change.select2');
                                $(el).select2('destroy');
                            }
                            try {
                                const options = @json($options ?? []);
                                $(el).select2(options);
                                if (currentValue !== null) {
                                    $(el).val(currentValue).trigger('change.select2');
                                }

                                $(el).off('change.hwk').on('change.hwk', function() {

                                    const selectedValue = $(this).val();
                                    const modelName = $(this).attr('wire:model');
                                    if (!modelName) return;
                                    const componentEl = el.closest('[wire\\:id]');
                                    if (!componentEl) return;
                                    const component = Livewire.find(
                                        componentEl.getAttribute('wire:id')
                                    );
                                    if (!component) return;
                                    component.set(modelName, selectedValue);
                                });

                            } catch (e) {
                                console.error('Select2 init failed:', e);
                            }
                        });
                    }
                };

                document.addEventListener('livewire:init', () => {
                    HwkSelect2.init();
                });

                document.addEventListener('DOMContentLoaded', () => {
                    HwkSelect2.init();
                });

                document.addEventListener('livewire:navigated', () => {
                    HwkSelect2.init();
                });

                Livewire.hook('morphed', ({
                    el
                }) => {
                    HwkSelect2.init(el);
                });
            }
        </script>
    @endscript
@endscript
