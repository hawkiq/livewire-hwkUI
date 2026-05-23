@props(['id', 'theme' => config('hwkui.editor.defaultTheme', 'snow'), 'toolbar' => null, 'model' => null])
@php
    \Hawkiq\Hwkui\Helpers\PluginLoader::require('Editor');
    $defaultToolbar = config('hwkui.editor.defaultToolbar', []);

    $customToolbar = collect(explode('|', $toolbar))->filter()->map(fn($item) => trim($item));

    $toolbarArray = !is_null($toolbar) && $customToolbar->isNotEmpty() ? [$customToolbar->toArray()] : $defaultToolbar;
@endphp

<div wire:ignore.self id="{{ $id }}" data-model="{{ $model }}" data-theme="{{ $theme }}"
    data-toolbar='@json($toolbarArray)' class="hwkui-quill-wrapper">
    <div class="quill-editor"></div>
</div>

@once
    @assets
        @include('hwkui::plugins', ['type' => 'css'])
        @include('hwkui::plugins', ['type' => 'js'])
    @endassets

@endonce


@script
    <script>
        if (!window.HwkEditorBooted) {

            window.HwkEditorBooted = true;

            window.HwkEditor = {

                init(scope = document) {

                    const wrappers = scope.classList?.contains('hwkui-quill-wrapper') ?
                        [scope] :
                        scope.querySelectorAll('.hwkui-quill-wrapper');

                    wrappers.forEach(wrapper => {

                        const editorEl = wrapper.querySelector('.quill-editor');
                        if (!editorEl) return;

                        const model = wrapper.dataset.model;
                        if (!model) return;

                        const componentEl = wrapper.closest('[wire\\:id]');
                        if (!componentEl) return;

                        const component = Livewire.find(
                            componentEl.getAttribute('wire:id')
                        );

                        if (!component) return;
                        let value = component.get(model) ?? '';
                        if (wrapper.__quill) {
                            wrapper.__quill.off('text-change');
                            wrapper.__quill = null;
                            editorEl.innerHTML = '';
                        }

                        wrapper.querySelectorAll('.ql-toolbar').forEach(el => el.remove());

                        let toolbar = [];

                        try {
                            toolbar = JSON.parse(wrapper.dataset.toolbar || '[]');
                        } catch (e) {
                            console.warn('Invalid toolbar JSON', e);
                        }

                        const theme = wrapper.dataset.theme || 'snow';
                        const quill = new Quill(editorEl, {
                            theme,
                            modules: {
                                toolbar
                            }
                        });

                        wrapper.__quill = quill;

                        if (value) {
                            quill.root.innerHTML = value;
                        }

                        quill.on('text-change', () => {
                            component.set(model, quill.root.innerHTML);
                        });
                    });
                }
            };

            document.addEventListener("livewire:init", () => HwkEditor.init());
            document.addEventListener("DOMContentLoaded", () => HwkEditor.init());
            document.addEventListener("livewire:navigated", () => HwkEditor.init());

            Livewire.hook("morphed", ({
                el
            }) => {
                HwkEditor.init(el);
            });
        }
    </script>
@endscript
