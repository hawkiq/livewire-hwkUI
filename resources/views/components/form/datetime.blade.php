@props([
    'label' => null,
    'placeholder' => null,
])
@php
    $hasLabel = filled($label);
    $hasPlaceholder = filled($placeholder);
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('Datetime');
@endphp

<div {{ $attributes->except('class', 'style')->merge(['class' => 'w-full'])->only('style') }}>
    @if ($hasLabel)
        <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <div wire:ignore class="relative">
        <input id="hwkdt-{{ uniqid() }}" type="text" placeholder="{{ $hasPlaceholder ? $placeholder : 'Select Date and Time' }}"
            data-options='@json($options)'
            {{ $attributes->merge(['class' => 'hwkdtpicker block w-full px-2 py-2 border rounded text-sm']) }}
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
    if (!window.HwkDatetimeBooted) {
        window.HwkDatetimeBooted = true;
        window.initPickers = function(root = document) {
            root.querySelectorAll('.hwkdtpicker').forEach(el => {
                if (el._td) {
                    el._td.dispose();
                    el._td = null;
                }

                let options = {};
                try {
                    options = el.dataset.options
                        ? JSON.parse(el.dataset.options)
                        : {};
                } catch (e) {
                    console.warn('TempusDominus options invalid JSON:', e);
                }

                // Modal support
                const modal = el.closest('dialog');

                if (modal) {
                    options.container = modal;
                } else {
                    options.container = el.parentElement;
                }

                el._td = new tempusDominus.TempusDominus(el, options);

                if (el._tdChangeHandler) {
                    el.removeEventListener("hide.td", el._tdChangeHandler);
                }

                el._tdChangeHandler = function() {

                    const componentEl = el.closest('[wire\\:id]');
                    if (!componentEl) return;

                    const component = Livewire.find(
                        componentEl.getAttribute('wire:id')
                    );
                    if (!component) return;
                    const modelName =
                        el.getAttribute("wire:model") ||
                        el.getAttribute("wire:model.live");

                    if (!modelName) return;

                    if (component.get(modelName) === el.value) {
                        return;
                    }
                    component.set(modelName, el.value);
                };

                el.addEventListener("hide.td", el._tdChangeHandler);
            });
        };

        document.addEventListener("DOMContentLoaded", () => {
            initPickers();
        });

        document.addEventListener("livewire:navigated", () => {
            initPickers();
        });

        Livewire.hook('morphed', ({ el }) => {
            initPickers(el);
        });
    }
</script>
@endscript
