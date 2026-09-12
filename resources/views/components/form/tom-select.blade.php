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

                        if (el.tomselect) {
                            el.tomselect.destroy();
                        }

                        try {

                            const userOptions = el.dataset.options ?
                                JSON.parse(el.dataset.options) : {};
                            const modalContainer = el.closest('dialog') || el.closest('[data-flux-modal]') || el
                                .closest('flux-modal');

                            const config = {
                                allowEmptyOption: true,
                                create: false,
                                plugins: ['dropdown_input'],
                                dropdownParent: modalContainer || 'body',
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

                            if (modalContainer) {
                                modalContainer.style.overflow = 'visible';

                                ts.positionDropdown = function() {
                                    const controlRect = this.control.getBoundingClientRect();
                                    const modalRect = modalContainer.getBoundingClientRect();

                                    this.dropdown.style.position = 'absolute';
                                    this.dropdown.style.top = (controlRect.bottom - modalRect.top +
                                        modalContainer.scrollTop) + 'px';
                                    this.dropdown.style.left = (controlRect.left - modalRect.left +
                                        modalContainer.scrollLeft) + 'px';
                                    this.dropdown.style.width = controlRect.width + 'px';
                                    this.dropdown.style.zIndex = '99999';
                                };
                            }

                            const modelName = el.getAttribute('wire:model') || el.getAttribute(
                                'wire:model.live');

                            let initialComponentValue = null;
                            if (modelName) {
                                const componentEl = el.closest('[wire\\:id]');
                                const component = componentEl ? Livewire.find(componentEl.getAttribute(
                                    'wire:id')) : null;

                                if (component) {
                                    initialComponentValue = component.get(modelName);
                                }
                            }

                            if (initialComponentValue !== null && initialComponentValue !== undefined &&
                                initialComponentValue !== '' && !(Array.isArray(initialComponentValue) &&
                                    initialComponentValue.length === 0)) {
                                let values = Array.isArray(initialComponentValue) ? initialComponentValue : [
                                    initialComponentValue
                                ];
                                values.forEach(val => {
                                    if (val !== '' && !ts.options[val]) {
                                        ts.addOption({
                                            value: val,
                                            text: val
                                        });
                                    }
                                });
                                ts.setValue(initialComponentValue, true);
                            } else {
                                ts.clear(true);
                            }

                            if (modelName) {
                                const componentEl = el.closest('[wire\\:id]');
                                const component = componentEl ? Livewire.find(componentEl.getAttribute(
                                    'wire:id')) : null;

                                if (component) {

                                    ts.on('change', value => {
                                        if (typeof value !== 'undefined') {
                                            component.set(modelName, value);
                                        }
                                    });

                                    if (typeof component.$watch === 'function') {
                                        component.$watch(modelName, (newValue) => {

                                            let currentTsValue = ts.getValue();

                                            let tsArray = Array.isArray(currentTsValue) ?
                                                currentTsValue : (currentTsValue ? [currentTsValue] :
                                                []);
                                            let lwArray = Array.isArray(newValue) ? newValue : (
                                                newValue ? [newValue] : []);

                                            let tsString = JSON.stringify(tsArray.map(String).sort());
                                            let lwString = JSON.stringify(lwArray.map(String).sort());

                                            if (tsString === lwString) {
                                                return;
                                            }

                                            if (newValue === null || newValue === undefined ||
                                                newValue === '') {
                                                ts.clear(true);
                                                return;
                                            }

                                            let values = Array.isArray(newValue) ? newValue : [
                                                newValue
                                            ];

                                            values.forEach(val => {
                                                if (val !== '' && !ts.options[val]) {
                                                    ts.addOption({
                                                        value: val,
                                                        text: val
                                                    });
                                                }
                                            });

                                            ts.setValue(newValue, true);
                                        });
                                    }
                                }
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
