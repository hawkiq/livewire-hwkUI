# hwkUI

[![Packagist](https://img.shields.io/packagist/v/hawkiq/hwkui.svg)](https://packagist.org/packages/hawkiq/hwkui)

**hwkUI** is a Laravel package providing ready-to-use UI widgets built on top of **Livewire 3**, designed for simplicity and flexibility. It includes dynamic Select2 components and more coming soon.

## 📦 Requirements

- Laravel **10.x**
- Livewire **3.x**
- PHP **8.1+**

> ⚠️ This package does **not** auto-install `select2/select2`. It loads assets via CDN by default, but you can switch to **local assets** easily (see below).

---

## 🚀 Installation

```bash
composer require hawkiq/hwkui
```

## ⛔ Before You Continue

```bash
php artisan --version
# Laravel Framework 10.x

php artisan livewire:info
# Livewire v3.x installed and configured
```

## ⚙️ Configuration
The config file `config/hwkui.php` defines which JS/CSS plugins to load and whether to use CDN or local assets.

### 1. Publish the Config File

```bash
php artisan vendor:publish --tag=hwkui-config
```

This will create `config/hwkui.php`.

## 🌐 Using CDN (Default)
By default, hwkUI uses CDN links for plugins like jQuery, Select2, and DataTables.

Example from `config/hwkui.php`:

```php
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
            'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js',
        ],
    ],
],

```

## 🗂️ Using Local Assets (Optional)

If you prefer to serve local assets (for offline use or better performance), follow these steps:
### Step 1: Download Required JS/CSS Files

You must download the files manually:

    jQuery: https://code.jquery.com/jquery-3.7.1.min.js

    Select2:

        CSS: https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css

        JS: https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js

    Place them under `public/vendor/hwkui/` or another folder of your choice.

### Step 2: Update config/hwkui.php

Change asset => true and point to your local file path:

```php
'Select2' => [
    'active' => true,
    'files' => [
        [
            'type' => 'css',
            'asset' => true,
            'location' => 'vendor/hwkui/select2.min.css',
        ],
        [
            'type' => 'js',
            'asset' => true,
            'location' => 'vendor/hwkui/select2.min.js',
        ],
    ],
],

```

Laravel will generate the full asset URL using `asset('vendor/hwkui/select2.min.css')`.

## 🧩 Usage

# Select2 Component

In your Blade view:

```blade
 <x-hwkui-select wire:model="selectedItem" label="Select User to PLay" placeholder="Select a user Babe">
            @forelse ($users as $user)
                <option wire:key="{{ $user->id }}" value="{{ $user->name }}">{{ $user->name }}</option>
            @empty
                <option value="">No options available</option>
            @endforelse
        </x-hwkui-select>

```
Make sure to include Livewire and the component's scripts on your page.

you can pass options for Select2 like via component

```blade
<x-hwkui-select
    wire:model="selectedUser"
    label="Choose User"
    :options="$options" 
>
</x-hwkui-select>

```

or direct array

```blade
<x-hwkui-select
    wire:model="selectedUser"
    label="Choose User"
    :options="[
         'placeholder' => 'Select an option',
        'allowClear' => true,
        'multiple' => true,
    ]" 
>
</x-hwkui-select>

```

# DateTime Picker Component

don't forget to make it active in config

```php
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
```

in your blade use it like this

```blade

 <x-hwkui-datetime id="test-datetime" label="Test DateTime"
        placeholder="Select Date" wire:model="setDatetime" />

```

if you want to set default options for datetime you can do it in `config/hwkui.php`

```php

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
                'format' => 'yyyy-MM-dd hh:mm',
                'locale' => app()->getLocale(),
            ],
        ],
    ],


```

these are just few options from many to be set you can visit original plugin [Options page](https://getdatepicker.com/6/options/) and see what you can add.

## override Options

you can override Datetime picker just by pass an array to `:options`

```blade

 <x-hwkui-datetime id="test-datetime" :options="[
        'display' => [
            'components' => [
                'date' => false,
                'year' => true,
                'month' => true,
                'clock' => false,
            ],
        ],
        'localization' => [
            'format' => 'yyyy-MM h:i:s',
            'locale' => app()->getLocale(),
        ],
    ]" class="border-amber-500" label="Test DateTime"
        placeholder="Select Date" wire:model="setDatetime" />

```


## 🧪 Testing

Run:
```bash
php artisan serve
```
Then visit your Livewire component using hwkUI widgets. All assets should be loaded either via CDN or local as per your config.

## 🔧 Customization

Feel free to extend or publish views if needed:

```bash
php artisan vendor:publish --tag=hwkui-views
```

## 📝 License

This project is open-sourced under the MIT license.

## 👤 Author

hawkiq

Enjoy building awesome interfaces with hwkUI! 🚀
