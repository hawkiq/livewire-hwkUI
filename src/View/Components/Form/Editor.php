<?php

namespace Hawkiq\Hwkui\View\Components\Form;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Editor extends Component
{
    public string $id;

    public ?string $profile;

    public ?int $height;

    public readonly bool $fileBrowser;

    public ?string $placeholder;

    public ?string $language;

    public array $options;

    public readonly ?string $connectorUrl;

    public array $mentions;

    public string $trigger;

    public string $displayKey;

    public string $valueKey;

    public $renderCallback;

    public $insertCallback;

    public ?string $renderView;

    public ?string $insertView;

    public array $extraButtons;

    public function __construct(
        ?string $id = null,
        ?string $profile = null,
        ?int $height = null,
        ?string $placeholder = null,
        ?string $language = null,
        array $options = [],
        $fileBrowser = false,
        ?string $connectorUrl = null,
        $mentions = [],
        string $trigger = '@',
        string $displayKey = 'name',
        string $valueKey = 'id',
        $renderCallback = null,
        $insertCallback = null,
        ?string $renderView = null,
        ?string $insertView = null,
        array $extraButtons = []
    ) {
        $this->id = $id ?? 'jodit-'.md5(uniqid((string) rand(), true));
        $this->profile = $profile ?? config('hwkui.editor.default_profile', 'simple');
        $this->height = $height;
        $this->placeholder = $placeholder;
        $this->language = $language;
        $this->options = $options;
        $this->fileBrowser = filter_var($fileBrowser, FILTER_VALIDATE_BOOLEAN);
        $this->mentions = $mentions instanceof Collection ? $mentions->toArray() : (array) $mentions;
        $this->trigger = $trigger;
        $this->displayKey = $displayKey;
        $this->valueKey = $valueKey;

        $this->renderCallback = $renderCallback;
        $this->insertCallback = $insertCallback;
        $this->renderView = $renderView;
        $this->insertView = $insertView;

        $this->connectorUrl = $this->resolveConnectorUrl($connectorUrl);
        $this->extraButtons = $extraButtons;
    }

    public function render()
    {
        return view('hwkui::components.form.editor', [
            'joditConfig' => $this->getJoditConfig(),
            'processedMentions' => array_map([$this, 'processMentionItem'], $this->mentions),
            'triggerKey' => $this->trigger,
            'extraButtons' => $this->extraButtons,
        ]);
    }

    public function getJoditConfig(): array
    {
        $config = config('hwkui.editor', []);

        $mergedOptions = array_merge($config['defaults'] ?? [], [
            'buttons' => $config['profiles'][$this->profile] ?? $config['profiles']['full'] ?? [],
        ]);

        if ($this->height) {
            $mergedOptions['height'] = $this->height > 0 ? $this->height : (int) config('hwkui.editor.defaults.height', 350);
        }

        if ($this->placeholder) {
            $mergedOptions['placeholder'] = $this->placeholder;
        }

        $language = $this->language ?? $config['language'] ?? null;
        if ($language) {
            $mergedOptions['language'] = $language;
        }

        $this->appendUploaderConfig($mergedOptions);

        return array_replace_recursive($mergedOptions, $this->options);
    }

    private function processMentionItem(mixed $item): array
    {
        $itemArray = is_object($item) ? (array) $item : $item;

        return [
            'raw' => $itemArray,
            'display_html' => $this->getDisplayHtml($itemArray),
            'insert_html' => $this->getInsertHtml($itemArray),
            'search_text' => strtolower($itemArray[$this->displayKey] ?? ''),
        ];
    }

    private function getDisplayHtml(array $item): string
    {
        if ($this->renderView) {
            return view($this->renderView, compact('item'))->render();
        }

        if (is_callable($this->renderCallback)) {
            return call_user_func($this->renderCallback, $item);
        }

        return e($item[$this->displayKey] ?? '');
    }

    private function getInsertHtml(array $item): string
    {
        if ($this->insertView) {
            return view($this->insertView, compact('item'))->render();
        }

        if (is_callable($this->insertCallback)) {
            return call_user_func($this->insertCallback, $item);
        }

        return $this->trigger.e($item[$this->displayKey] ?? '');
    }

    private function resolveConnectorUrl(?string $connectorUrl): ?string
    {
        if ($connectorUrl !== null) {
            return $connectorUrl;
        }

        $routeName = config('hwkui.editor.route.name', 'jodit.uploader');

        if ($this->fileBrowser) {
            return $routeName;
        }

        return $routeName;
    }

    private function appendUploaderConfig(array &$mergedOptions): void
    {
        if (! $this->connectorUrl) {
            return;
        }

        $csrfToken = csrf_token();

        $mergedOptions['uploader'] = [
            'url' => route($this->connectorUrl, ['action' => 'upload']),
            'headers' => ['X-CSRF-TOKEN' => $csrfToken],
            'format' => 'json',
            'insertImageAsBase64URI' => false,
        ];

        if ($this->fileBrowser) {
            $mergedOptions['filebrowser'] = [
                'ajax' => [
                    'url' => route($this->connectorUrl, ['action' => 'browse']),
                    'headers' => ['X-CSRF-TOKEN' => $csrfToken],
                ],
                'uploader' => [
                    'url' => route($this->connectorUrl, ['action' => 'upload']),
                    'headers' => ['X-CSRF-TOKEN' => $csrfToken],
                ],
            ];
        }
    }
}
