@props([
    'label' => null,
    'options' => [],
    'placeholder' => null,
])
@php
    $hasLabel = filled($label);
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('TomSelect');
@endphp

<div {{ $attributes->except(['class', 'style'])->merge(['class' => 'w-full'])->only('style') }}>
    @if ($hasLabel)
        <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif
    <div wire:ignore class="relative">
        <select {{ $attributes->merge(['class' => 'tom-select block w-full']) }}
            data-options='@json($options)' style="{{ $attributes->get('style') ?? '' }}">
            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif
            {{ $slot }}
        </select>
    </div>
</div>

@once
    @assets
        @include('hwkui::plugins', ['type' => 'css'])
        @include('hwkui::plugins', ['type' => 'js'])
    @endassets
@endonce

@script
    <script>
        if (!window.HwkTomSelectBooted) {

            window.HwkTomSelectBooted = true;

            window.HwkTomSelect = {

                init(scope = document) {

                    const targets = scope.classList?.contains('tom-select') ? [scope] :
                        scope.querySelectorAll('.tom-select');

                    targets.forEach(el => {

                        let currentValue = null;

                        if (el.tomselect) {
                            currentValue = el.tomselect.getValue();
                            el.tomselect.destroy();
                        }

                        try {

                            const userOptions = el.dataset.options ?
                                JSON.parse(el.dataset.options) : {};

                            const config = {
                                allowEmptyOption: true,
                                create: false,
                                plugins: ['dropdown_input'],
                                dropdownParent: 'body',
                                ...userOptions,

                                render: {
                                    option: function(data, escape) {
                                        if (data.value === undefined || data.value === null)
                                            return '<div></div>';

                                        return `<div>${escape(data.text)}</div>`;
                                    },

                                    item: function(data, escape) {
                                        if (data.value === undefined || data.value === null)
                                            return '<div></div>';

                                        return `<div>${escape(data.text)}</div>`;
                                    }
                                }
                            };

                            const ts = new TomSelect(el, config);
                            if (currentValue !== null) {
                                ts.setValue(currentValue, true);
                            }
                            const modelName =
                                el.getAttribute('wire:model') ||
                                el.getAttribute('wire:model.live');

                            if (modelName) {

                                ts.on('change', value => {

                                    if (typeof value === 'undefined') {
                                        return;
                                    }

                                    const componentEl = el.closest('[wire\\:id]');
                                    if (!componentEl) return;

                                    const component = Livewire.find(
                                        componentEl.getAttribute('wire:id')
                                    );

                                    if (!component) return;

                                    component.set(modelName, value);
                                });
                            }

                        } catch (e) {
                            console.error('TomSelect init failed:', e);
                        }
                    });
                }
            };

            document.addEventListener('livewire:init', () => {
                HwkTomSelect.init();
            });

            document.addEventListener('DOMContentLoaded', () => {
                HwkTomSelect.init();
            });

            document.addEventListener('livewire:navigated', () => {
                HwkTomSelect.init();
            });

            Livewire.hook('morphed', ({
                el
            }) => {
                HwkTomSelect.init(el);
            });
        }
    </script>
@endscript
