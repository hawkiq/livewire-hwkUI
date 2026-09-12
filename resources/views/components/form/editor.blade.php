@props([
    'disabled' => false,
])

@php
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('Editor');
@endphp

<div x-data="hwkuiJoditEditor({
    value: @entangle($attributes->wire('model')),
    config: {{ Js::from($joditConfig) }},
    isDisabled: @js($disabled)
})" x-id="['jodit-editor']" wire:ignore {{ $attributes->whereDoesntStartWith('wire:model') }}
    class="hwkui-jodit-wrapper w-full">
    <textarea x-ref="textarea" :id="$id('jodit-editor')"></textarea>
</div>

@once
    @assets
        @include('hwkui::plugins', ['type' => 'css'])
        @include('hwkui::plugins', ['type' => 'js'])
    @endassets

@endonce


@script
    <script>
        // Define it directly without listening for 'alpine:init'
        Alpine.data('hwkuiJoditEditor', ({
            value,
            config,
            isDisabled
        }) => ({
            value: value,
            config: config,
            isDisabled: isDisabled,
            editor: null,

            init() {
                
                // Allow global plugin pre-registration or config mutation
                if (typeof window.hwkuiBeforeJoditInit === 'function') {
                    this.config = window.hwkuiBeforeJoditInit(this.config, Jodit) || this.config;
                }

                // Dispatch event for inline JS plugin hook
                this.$el.dispatchEvent(new CustomEvent('jodit:before-init', {
                    detail: {
                        config: this.config,
                        Jodit
                    },
                    bubbles: true
                }));

                // Instantiate Jodit
                this.editor = Jodit.make(this.$refs.textarea, this.config);

                if (isDisabled) {
                    this.editor.setReadOnly(true);
                }

                // Set initial value
                if (this.value) {
                    this.editor.value = this.value;
                }

                // Sync Jodit -> Alpine / Livewire
                this.editor.events.on('change', (newVal) => {
                    if (this.value !== newVal) {
                        this.value = newVal;
                    }
                });

                // Sync Alpine / Livewire -> Jodit
                this.$watch('value', (newVal) => {
                    if (this.editor && this.editor.value !== newVal) {
                        this.editor.value = newVal || '';
                    }
                });

                // Handle disabled state changes dynamically
                this.$watch('isDisabled', (isReadOnly) => {
                    if (this.editor) {
                        this.editor.setReadOnly(isReadOnly);
                    }
                });

                // Allow post-initialization hooks
                if (typeof window.hwkuiAfterJoditInit === 'function') {
                    window.hwkuiAfterJoditInit(this.editor, Jodit);
                }

                this.$el.dispatchEvent(new CustomEvent('jodit:ready', {
                    detail: {
                        editor: this.editor,
                        Jodit
                    },
                    bubbles: true
                }));
            },

            destroy() {
                if (this.editor) {
                    this.editor.destruct();
                    this.editor = null;
                }
            }
        }));
    </script>
@endscript
