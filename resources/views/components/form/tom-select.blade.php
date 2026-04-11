@props([
    'label' => null,
    'options' => [],
    'placeholder' => null,
])
@php
    $hasLabel = filled($label);
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('TomSelect');
@endphp

<div wire:ignore {{ $attributes->except(['class', 'style'])->merge(['class' => 'w-full'])->only('style') }}>
    @if ($hasLabel)
        <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ $label }}
        </label>
    @endif

    <select {{ $attributes->merge(['class' => 'tom-select block w-full']) }} data-options='@json($options)'
        style="{{ $attributes->get('style') ?? '' }}">
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
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
        window.initTomSelect = function(scope = document) {
            const targets = scope.classList?.contains('tom-select') ?
                [scope] :
                scope.querySelectorAll('.tom-select');

            targets.forEach(el => {
                if (el.tomselect) {
                    return;
                }

                try {
                    const userOptions = el.dataset.options ? JSON.parse(el.dataset.options) : {};

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

                    el.tomselect = new TomSelect(el, config);
                } catch (e) {
                    console.error("TomSelect init failed:", e);
                }

                const modelName = el.getAttribute('wire:model') || el.getAttribute('wire:model.live');
                if (!modelName) return;

                el.tomselect.on('change', value => {
                    if (typeof value === 'undefined') return;
                    $wire.$set(modelName, value);
                });
            });
        };

        document.addEventListener('livewire:initialized', () => {
            window.initTomSelect();
            Livewire.hook('morph.updated', ({
                el
            }) => {
                window.initTomSelect(el);
            });
        });
    </script>
@endscript
