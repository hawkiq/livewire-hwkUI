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
    <script>
        $(document).ready(function() {
            $('.select2').select2(@json($options));
            $('.select2').on('change', function(e) {
                let selectedValue = $(this).val();
                let modelName = $(this).attr('wire:model');
                if (modelName) {
                    $wire.set(modelName, selectedValue);
                }
            });
        });
        Livewire.hook("morphed", () => {
            $('.select2').select2(@json($options));
            $('.select2').on('change', function(e) {
                let selectedValue = $(this).val();
                let modelName = $(this).attr('wire:model');
                if (modelName) {
                    $wire.set(modelName, selectedValue);
                }
            });
        });
    </script>
@endscript
