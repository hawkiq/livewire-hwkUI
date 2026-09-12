<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    |
    */

    'plugins' => [
        'Jquery' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//code.jquery.com/jquery-3.7.1.min.js',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js',
                ],
            ],
        ],
        'Datetime' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/js/tempus-dominus.min.js',
                ],
            ],
        ],
        'Datatable' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/dt/dt-2.3.2/b-3.2.4/b-colvis-3.2.4/b-html5-3.2.4/b-print-3.2.4/r-3.0.5/datatables.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdn.datatables.net/v/dt/dt-2.3.2/b-3.2.4/b-colvis-3.2.4/b-html5-3.2.4/b-print-3.2.4/r-3.0.5/datatables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js',
                ],
            ],
        ],
        'Editor' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/jodit@latest/es2021/jodit.fat.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdn.jsdelivr.net/npm/jodit@latest/es2021/jodit.fat.min.js',
                ],
            ],
        ],
        'TomSelect' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/css/tom-select.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdn.jsdelivr.net/npm/tom-select@2.5.2/dist/js/tom-select.complete.min.js',
                ],
            ],
        ],
        'FlatPicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdn.jsdelivr.net/npm/flatpickr',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Configuration
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugin configuration defaults.
    |
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Date Time Picker Configuration
    |--------------------------------------------------------------------------
    |
    | Here we can modify the date time picker configuration defaults.
    | You can see full List of options can be used here: https://getdatepicker.com/6/options/
    |
    */
    'datetime' => [
        'defaultOptions' => [
            'display' => [
                'viewMode' => 'calendar',
                'components' => [
                    'calendar' => true,
                    'date' => true,
                    'year' => true,
                    'month' => true,
                    'clock' => true,
                ],
                'calendarWeeks' => false,
            ],
            'debug' => false,
            'useCurrent' => true,
            'stepping' => 1,
            'localization' => [
                // 'format' => 'yyyy-MM-dd hh:mm',
                'locale' => app()->getLocale(),
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Jodit rich text editor Configuration
    |--------------------------------------------------------------------------
    |
    | Here we can modify the Jodit rich text editor configuration defaults.
    | You can see full List of options can be used here: https://xdsoft.net/jodit/docs/options.html
    |
    */
    'editor' => [
        /*
    |--------------------------------------------------------------------------
    | Connector Route
    |--------------------------------------------------------------------------
    |
    | The package can register its own connector route automatically.
    | Set `enabled` to false and register the route yourself if
    | you need a custom prefix or middleware stack.
    |
    */
        'route' => [
            'enabled'    => true,
            'prefix'     => 'jodit',
            'name'       => 'jodit.uploader',
            'middleware' => ['web', 'auth', 'throttle:60,1'],
        ],
        'uploader' => [
            'disk'           => 'public',
            'base_path'      => 'uploads',
            'max_file_size'       => 12833,  // kilobytes
            'allowed_mimes'       => 'jpeg,jpg,png,gif,webp,pdf,doc,docx,xls,xlsx,zip,txt',
            'preserve_file_names' => false,
            'user_directory' => true,
        ],
        /*
    |--------------------------------------------------------------------------
    | Editor Language
    |--------------------------------------------------------------------------
    |
    | UI language for the Jodit toolbar and dialogs. Set to null to let the
    | browser decide (Jodit auto-detects from navigator.language).
    | Examples: 'en', 'ar', 'fr', 'de', 'zh_cn'.
    |
    */
        'language' => 'en',

        /*
    |--------------------------------------------------------------------------
    | Default Editor Options
    |--------------------------------------------------------------------------
    |
    | Any key/value pair here is merged into the Jodit config object before
    | the editor is instantiated.  See https://xdsoft.net/jodit/docs/ for all
    | available options.
    |
    */
        'defaults' => [
            'height'               => 350,
            'toolbarSticky'        => true,
            'toolbarButtonSize'    => 'middle',
            'showCharsCounter'     => true,
            'showWordsCounter'     => true,
            'showXPathInStatusbar' => true,
            'hidePoweredByJodit'   => true,
            'defaultActionOnPaste' => 'insert_clear_html',
        ],

        /*
    |--------------------------------------------------------------------------
    | Toolbar Profiles
    |--------------------------------------------------------------------------
    |
    | Named button sets. Select a profile per-instance with the `profile` prop:
    |   <x-hwkui-editor name="content" profile="simple" />
    |
    | `default_profile` is used when no `buttons` or `profile` prop is given.
    | Set to null to fall back to the `buttons` array defined above.
    |
    */

        'default_profile' => 'simple',
        'profiles' => [
            'full' => [
                'undo',
                'redo',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                'superscript',
                'subscript',
                'eraser',
                '|',
                'paragraph',
                'font',
                'fontsize',
                'brush',
                'classSpan',
                '|',
                'align',
                'ul',
                'ol',
                'indent',
                'outdent',
                '|',
                'cut',
                'copy',
                'paste',
                'selectall',
                '|',
                'link',
                'image',
                'video',
                'file',
                'table',
                'hr',
                'symbols',
                '|',
                'source',
                '|',
                'find',
                'spellcheck',
                'preview',
                'fullsize',
            ],
            'simple' => [
                'bold',
                'italic',
                'underline',
                'strikethrough',
                '|',
                'eraser',
                '|',
                'brush',
                'fontsize',
                'paragraph',
                '|',
                'link',
                'image',
                'video',
                '|',
                'undo',
                'redo',
                '|',
                'ul',
                'ol',
                'table',
                '|',
            ],
            'minimal' => [
                'bold',
                'italic',
                'eraser',
                '|',
                'source',
                '|',
                'link',
            ],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Flat Picker Date Time Configuration
    |--------------------------------------------------------------------------
    |
    | Here we can modify the flat picker configuration defaults.
    | You can see full List of options can be used here: https://flatpickr.js.org/options/
    |
    */
    'flat-picker' => [
        'defaultOptions' => [
            'enableTime' => true,
            'dateFormat' => 'Y-m-d H:i',
            'time_24hr' => true,
            'allowInput' => false,
            'altInput' => true,
            'altFormat' => 'Y-m-d H:i',
            'minuteIncrement' => 5,
        ],
    ],
];
