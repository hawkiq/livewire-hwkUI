@props(['id', 'theme' => config('hwkui.editor.defaultTheme', 'snow'), 'toolbar' => null, 'model' => null])
@php
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('Editor');
    $defaultToolbar = config('hwkui.editor.defaultToolbar', []);

    $customToolbar = collect(explode('|', $toolbar))->filter()->map(fn($item) => trim($item));

    $toolbarArray = !is_null($toolbar) && $customToolbar->isNotEmpty() ? [$customToolbar->toArray()] : $defaultToolbar;
@endphp

<div wire:ignore id="{{ $id }}" data-model="{{ $model }}" data-theme="{{ $theme }}"
    data-toolbar='@json($toolbarArray)' class="hwkui-quill-wrapper">
    <div class="quill-editor"></div>
</div>

@once
    @assets
        @include('hwkui::plugins', ['type' => 'css'])
        @include('hwkui::plugins', ['type' => 'js'])
        <style>
            .dark .ql-toolbar .ql-stroke,
            .dark .ql-toolbar .ql-fill,
            .dark .ql-toolbar .ql-picker {
                stroke: #bbb !important;
                //fill: #bbb !important;
                color: #bbb !important;
            }
        </style>
    @endassets

@endonce


@script
    <script>
        window.initEditor = function() {
            document.querySelectorAll('.hwkui-quill-wrapper').forEach(wrapper => {
                if (wrapper.dataset.initialized) return;

                const theme = wrapper.dataset.theme || config('hwkui.editor.defaultTheme', 'snow');
                const model = wrapper.dataset.model;
                const toolbar = JSON.parse(wrapper.dataset.toolbar || '[]');
                const editorEl = wrapper.querySelector('.quill-editor');
                const quill = new Quill(editorEl, {
                    theme: theme,
                    modules: {
                        toolbar: toolbar
                    }
                });

                wrapper.dataset.initialized = true;

                const component = Livewire.find(wrapper.closest('[wire\\:id]')?.getAttribute('wire:id'));
                if (!component || !model) return;

                const value = component.$wire?.get?.(model) ?? '';
                quill.root.innerHTML = value;
                quill.on('text-change', () => {
                    const html = quill.root.innerHTML;
                    component.set(model, html);
                });
            });
        }

        document.addEventListener("livewire:init", () => {
            initEditor();
        });

        document.addEventListener("DOMContentLoaded", () => {
            initEditor();
        });

        document.addEventListener("livewire:navigated", () => {
            initEditor();
        });

        Livewire.hook("morphed", () => {
            initEditor();
        });
    </script>
@endscript
