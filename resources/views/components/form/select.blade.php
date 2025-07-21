<label for="{{ $attributes->get('id') }}" class="block text-lg font-medium text-gray-700 dark:text-gray-300">
    @if ($label)
        {{ $label }}
    @endif
    <select {{ $attributes->merge(['class' => 'select2']) }} style="width: 100%">
        {{ $slot }}
    </select>
</label>

@once
    @assets
        @include('hwkui::plugins', ['type' => 'css'])
        @include('hwkui::plugins', ['type' => 'js'])
        <style>
            .select2-container--default .select2-selection--single {
                height: 2.5rem;
                padding: 0.5rem;
                border-radius: 0.375rem;
                border: 1px solid #9ca3af;
                background-color: #ffffff;
                color: #111827;
            }

            html.dark .select2-container--default .select2-selection--single {
                background-color: #1f2937;
                color: #f9fafb;
                border-color: #4b5563;
            }

            .select2-dropdown {
                background-color: #f9fafb;
                color: #111827;
                border-radius: 0.5rem;
                border: 1px solid #cbd5e1;
                overflow: hidden;
            }

            html.dark .select2-dropdown {
                background-color: #1f2937;
                color: #f9fafb;
                border-color: #4b5563;
            }

            .select2-results__option {
                padding: 0.5rem 1rem;
            }

            .select2-results__option--highlighted {
                background-color: #3b82f6;
                color: white;
            }
        </style>
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
