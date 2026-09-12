@props([
    'label' => null,
    'placeholder' => null,
])
@php
    $hasLabel = filled($label);
    $hasPlaceholder = filled($placeholder);
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('FlatPicker');
@endphp

<div {{ $attributes->except('class', 'style')->merge(['class' => 'w-full'])->only('style') }}>
    @if ($hasLabel)
        <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <div wire:ignore class="relative">
        <input id="{{ $attributes->get('id') }}" type="text"
            placeholder="{{ $hasPlaceholder ? $placeholder : 'Select Date and Time' }}"
            data-options='@json($options)'
            {{ $attributes->merge(['class' => 'hwkflatpicker block w-full px-2 py-2 border rounded-md text-sm']) }}
            style="{{ $attributes->get('style') ?? '' }};" autocomplete="off" />
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
        if (!window.HwkFlatPickerBooted) {

            window.HwkFlatPickerBooted = true;
            window.HwkFlatPicker = {

                init(root = document) {
                    root.querySelectorAll('.hwkflatpicker').forEach((el) => {

                        if (el._flatpickr) {
                            el._flatpickr.destroy();
                        }

                        let options = {};

                        // Fix for modals / dialogs
                        options.static = true;
                        options.disableMobile = true;

                        try {
                            const dataOpts = el.dataset.options ? JSON.parse(el.dataset.options) : {};
                            options = {...options,...dataOpts};
                        } catch (e) {
                            console.warn('Flatpickr options invalid JSON:', e);
                        }

                        if (options.plugins) {
                            options.plugins = options.plugins.map(plugin => {

                                if (plugin.type === 'monthSelect') {
                                    return new monthSelectPlugin(plugin.config || {});
                                }

                                if (plugin.type === 'yearSelect') {
                                    return new yearSelectPlugin(plugin.config || {});
                                }

                                return plugin;
                            });
                        }

                        const modelName = el.getAttribute("wire:model") || el.getAttribute("wire:model.live");
                        let initialValue = el.value;

                        if (modelName) {
                            const componentEl = el.closest('[wire\\:id]');
                            if (componentEl) {
                                const component = Livewire.find(componentEl.getAttribute('wire:id'));
                                if (component) {
                                    const livewireVal = component.get(modelName);
                                    if (livewireVal !== null && livewireVal !== undefined) {
                                        initialValue = livewireVal;
                                    }
                                }
                            }
                        }

                        options.onClose = function(selectedDates, dateStr) {
                            const componentEl = el.closest('[wire\\:id]');
                            if (!componentEl) return;

                            const component = Livewire.find(componentEl.getAttribute('wire:id'));
                            if (!component) return;

                            if (!modelName) return;

                            component.set(modelName, dateStr);
                        };

                        const fp = flatpickr(el, options);

                        if (initialValue !== null && initialValue !== undefined && initialValue !== '') {
                            try {
                                fp.setDate(initialValue, false);
                            } catch (e) {
                                console.warn('Invalid flatpickr date:', initialValue);
                            }
                        } else {
                            fp.clear(true);
                        }

                        if (modelName) {
                            const componentEl = el.closest('[wire\\:id]');
                            if (componentEl) {
                                const component = Livewire.find(componentEl.getAttribute('wire:id'));
                                if (component && typeof component.$watch === 'function') {
                                    component.$watch(modelName, (newValue) => {

                                        if (newValue === null || newValue === undefined || newValue ===
                                            '') {
                                            if (fp.selectedDates.length > 0) {
                                                fp.clear(true);
                                            }
                                            return;
                                        }

                                        const currentDate = fp.selectedDates.length ? fp.formatDate(fp
                                            .selectedDates[0], options.dateFormat || "Y-m-d") : "";

                                        if (newValue !== currentDate) {
                                            fp.setDate(newValue, false);
                                        }
                                    });
                                }
                            }
                        }
                    });
                },
            };

            document.addEventListener("livewire:init", () => {
                HwkFlatPicker.init();
            });

            document.addEventListener("DOMContentLoaded", () => {
                HwkFlatPicker.init();
            });

            document.addEventListener("livewire:navigated", () => {
                HwkFlatPicker.init();
            });

            Livewire.hook('morphed', ({el}) => {
                HwkFlatPicker.init(el);
            });
        }
    </script>
@endscript
