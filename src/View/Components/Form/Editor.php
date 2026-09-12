<?php

namespace Hawkiq\Hwkui\View\Components\Form;

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


    public function __construct(
        ?string $id = null,
        ?string $profile = null,
        ?int $height = null,
        ?string $placeholder = null,
        ?string $language = null,
        array $options = [],
        $fileBrowser = false,
        ?string $connectorUrl = null
    ) {
        $this->id = $id ?? 'jodit-' . md5(uniqid(rand(), true));
        $this->profile = $profile ?? config('hwkui.editor.default_profile', 'simple');
        $this->height = $height;
        $this->placeholder = $placeholder;
        $this->language = $language;
        $this->options = $options;
        $this->fileBrowser = filter_var($fileBrowser, FILTER_VALIDATE_BOOLEAN);
        if ($connectorUrl !== null) {
            $this->connectorUrl = $connectorUrl;
        } elseif ($fileBrowser) {
            $routeName = config('hwkui.editor.route.name', 'jodit.uploader');
            try {
                $this->connectorUrl = $routeName;
            } catch (\InvalidArgumentException) {
                $this->connectorUrl = null;
            }
        } else {
            $this->connectorUrl = config('hwkui.editor.route.name', 'jodit.uploader');
        }
    }

    public function getJoditConfig(): array
    {
        $config = config('hwkui.editor', []);

        $profiles = $config['profiles'] ?? [];
        $buttons = $profiles[$this->profile] ?? $profiles['full'] ?? [];

        $mergedOptions = array_merge($config['defaults'] ?? [], [
            'buttons' => $buttons,
        ]);

        if ($this->height) {
            $mergedOptions['height'] = $this->height > 0 ? $this->height : (int) config('hwkui.editor.defaults.height', 350);;
        }

        if ($this->placeholder) {
            $mergedOptions['placeholder'] = $this->placeholder;
        }

        if (!empty($config['language']) || $this->language) {
            $mergedOptions['language'] = $this->language ?? $config['language'];
        }

        if ($this->connectorUrl) {
            $csrfToken = csrf_token();

            $mergedOptions['uploader'] = [
                'url' => route($this->connectorUrl, ['action' => 'upload']),
                'headers' => ['X-CSRF-TOKEN' => $csrfToken],
                'format' => 'json',
                'insertImageAsBase64URI' => false,
            ];

            if ($this->fileBrowser) {
                $browseActionUrl = route($this->connectorUrl, ['action' => 'browse']);
                $uploadActionUrl = route($this->connectorUrl, ['action' => 'upload']);
                $mergedOptions['filebrowser'] = [
                    'ajax' => [
                        'url' => $browseActionUrl,
                        'headers' => ['X-CSRF-TOKEN' => $csrfToken],
                    ],
                    'uploader' => [
                        'url' => $uploadActionUrl,
                        'headers' => ['X-CSRF-TOKEN' => $csrfToken],
                    ]
                ];
            }
        }

        return array_replace_recursive($mergedOptions, $this->options);
    }

    public function render()
    {
        return view('hwkui::components.form.editor', [
            'joditConfig' => $this->getJoditConfig()
        ]);
    }
}
