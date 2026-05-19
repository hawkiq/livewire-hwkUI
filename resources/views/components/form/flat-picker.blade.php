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

                        try {
                            options = el.dataset.options ?
                                JSON.parse(el.dataset.options) : {};
                        } catch (e) {
                            console.warn('Flatpickr options invalid JSON:', e);
                        }

                        if (options.plugins) {
                            options.plugins = options.plugins.map(plugin => {

                                if (plugin.type === 'monthSelect') {
                                    return new monthSelectPlugin(plugin.config || {});
                                }

                                return plugin;
                            });
                        }

                        // Fix for modals / dialogs
                        options.static = true;
                        options.disableMobile = true;

                        options.onClose = function(selectedDates, dateStr) {
                            const componentEl = el.closest('[wire\\:id]');
                            if (!componentEl) return;

                            const component = Livewire.find(componentEl.getAttribute('wire:id'));
                            if (!component) return;

                            const model =
                                el.getAttribute("wire:model") ||
                                el.getAttribute("wire:model.live");

                            if (!model) return;

                            component.set(model, dateStr);
                        };
                        const existingValue = el.value;

                        const fp = flatpickr(el, options);

                        if (existingValue) {
                            try {
                                fp.setDate(existingValue, false);
                            } catch (e) {
                                console.warn('Invalid flatpickr date:', existingValue);
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
