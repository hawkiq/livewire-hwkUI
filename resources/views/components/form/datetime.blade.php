@props([
    'label' => null,
    'placeholder' => null,
])
@php
    $hasLabel = filled($label);
    $hasPlaceholder = filled($placeholder);
@endphp

<div {{ $attributes->except('class', 'style')->merge(['class' => 'w-full'])->only('style') }}>
    @if ($hasLabel)
        <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
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
        window.initPickers = function() {
            document.querySelectorAll('.hwkdtpicker').forEach(el => {

                if (el._td) {
                    el._td.dispose();
                    el._td = null;
                }

                let options = el.dataset.options ? JSON.parse(el.dataset.options) : {};
                // console.log("Initializing picker with:", options);
                el._td = new tempusDominus.TempusDominus(el, options);
                el.addEventListener("change.td", e => {
                    let modelName = el.getAttribute("wire:model");
                    if (modelName && window.Livewire) {
                        $wire.set(modelName, el.value);
                    }
                });
            });
        };


        document.addEventListener("livewire:init", () => {
            initPickers();
        });

        document.addEventListener("DOMContentLoaded", () => {
            initPickers();
        });

        document.addEventListener("livewire:navigated", () => {
            initPickers();
        });

        Livewire.hook("morphed", () => {
            initPickers();
        });
    </script>
@endscript
