@props([
    'disabled' => false,
])

@php
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('Editor');
@endphp

<div x-data="hwkuiJoditEditor({
    value: @entangle($attributes->wire('model')),
    config: {{ Js::from($joditConfig) }},
    isDisabled: @js($disabled),
    mentions: {{ Js::from($processedMentions) }},
    trigger: @js($triggerKey)
})" x-id="['jodit-editor']" wire:ignore {{ $attributes->whereDoesntStartWith('wire:model') }}
    class="hwkui-jodit-wrapper w-full relative">
    
    <!-- Textarea Target -->
    <textarea x-ref="textarea" :id="$id('jodit-editor')"></textarea>

    <!-- Dynamic Floating Popup Menu -->
    <div x-show="showMentions && filteredMentions.length > 0"
         x-transition
         :style="dropdownStyle"
         class="absolute z-50 bg-gray-200 dark:bg-zinc-900 border border-gray-200 shadow-xl rounded-md w-64 max-h-60 overflow-y-auto"
         style="display: none;">
        <ul class="py-1 text-xs text-gray-700 dark:text-gray-300">
            <template x-for="item in filteredMentions" :key="item.search_text">
                <li>
                    <button type="button" 
                            @click="insertSelectedItem(item)"
                            class="cursor-pointer text-xs w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-100 dark:focus:bg-gray-500 outline-none flex items-center gap-2"
                            x-html="item.display_html">
                    </button>
                </li>
            </template>
        </ul>
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
        Alpine.data('hwkuiJoditEditor', ({
            value,
            config,
            isDisabled,
            mentions,
            trigger
        }) => ({
            value: value,
            config: config,
            isDisabled: isDisabled,
            editor: null,
            mentions: mentions || [],
            trigger: trigger || '@',
            showMentions: false,
            mentionQuery: '',
            isTracking: false,
            dropdownStyle: 'top: 0px; left: 0px;',

            get filteredMentions() {
                if (!this.mentionQuery) return this.mentions;
                return this.mentions.filter(i => i.search_text.includes(this.mentionQuery.toLowerCase()));
            },

            updatePosition() {
                if (!this.editor) return;
                const rect = this.editor.selection.getRect();
                const wrapperRect = this.$el.getBoundingClientRect();

                if (rect) {
                    const top = rect.bottom - wrapperRect.top + 6;
                    const left = rect.left - wrapperRect.left;
                    this.dropdownStyle = `top: ${top}px; left: ${left}px;`;
                }
            },

            insertSelectedItem(item) {
                if (!this.editor) return;

                const sel = this.editor.selection;
                const node = sel.current();

                // Replace typed trigger + query text
                if (node && node.nodeValue) {
                    const text = node.nodeValue;
                    const lastTriggerIndex = text.lastIndexOf(this.trigger);
                    
                    if (lastTriggerIndex !== -1) {
                        node.nodeValue = text.substring(0, lastTriggerIndex);
                        sel.setCursorAfter(node);
                    }
                }

                this.editor.selection.insertHTML(item.insert_html + '&nbsp;');

                // Reset tracking state
                this.showMentions = false;
                this.isTracking = false;
                this.mentionQuery = '';
                
                this.value = this.editor.value;
            },

            init() {
                if (typeof window.hwkuiBeforeJoditInit === 'function') {
                    this.config = window.hwkuiBeforeJoditInit(this.config, Jodit) || this.config;
                }

                this.editor = Jodit.make(this.$refs.textarea, this.config);

                if (isDisabled) {
                    this.editor.setReadOnly(true);
                }

                if (this.value) {
                    this.editor.value = this.value;
                }

                // Track keystrokes and update coordinates
                this.editor.events.on('keydown', (e) => {
                    if (e.key === this.trigger) {
                        this.isTracking = true;
                        this.mentionQuery = '';
                        this.showMentions = true;
                        this.$nextTick(() => this.updatePosition());
                    } else if (this.isTracking) {
                        if (e.key === 'Escape' || e.key === ' ' || e.key === 'Enter') {
                            this.isTracking = false;
                            this.showMentions = false;
                        } else if (e.key === 'Backspace') {
                            this.mentionQuery = this.mentionQuery.slice(0, -1);
                            if (this.mentionQuery.length === 0) {
                                this.showMentions = false;
                                this.isTracking = false;
                            } else {
                                this.$nextTick(() => this.updatePosition());
                            }
                        } else if (e.key.length === 1) {
                            this.mentionQuery += e.key;
                            this.$nextTick(() => this.updatePosition());
                        }
                    }
                });

                this.editor.events.on('change', (newVal) => {
                    if (this.value !== newVal) {
                        this.value = newVal;
                    }
                });

                this.$watch('value', (newVal) => {
                    if (this.editor && this.editor.value !== newVal) {
                        this.editor.value = newVal || '';
                    }
                });

                this.$watch('isDisabled', (isReadOnly) => {
                    if (this.editor) {
                        this.editor.setReadOnly(isReadOnly);
                    }
                });
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