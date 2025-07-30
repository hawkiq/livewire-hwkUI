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
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//code.jquery.com/jquery-3.7.1.min.js',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
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
            'active' => true,
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
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'defer' => true,
                    'location' => '//cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js',
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
                //'format' => 'yyyy-MM-dd hh:mm',
                'locale' => app()->getLocale(),
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | quilljs rich text editor Configuration
    |--------------------------------------------------------------------------
    |
    | Here we can modify the quilljs rich text editor configuration defaults.
    | You can see full List of options can be used here: https://quilljs.com/docs/configuration/
    |
    */
    'editor' => [
        'defaultToolbar' => [
            [['font' => []]],
            [['header' => [1, 2, 3, 4, 5, 6, false]]],
            ['bold', 'italic', 'underline', 'strike'],
            [['color' => []], ['background' => []]],
            ['blockquote', 'code-block'],
            ['link', 'image', 'video', 'formula'],
            [['list' => 'ordered'], ['list' => 'bullet'], [['script' => 'sub'], ['script' => 'super']]],
            [['indent' => '-1'], ['indent' => '+1']],
            [['direction' => 'rtl']],
            [['align' => []]],
            ['clean'],
        ],
        'defaultTheme' => 'snow',
    ],
];
