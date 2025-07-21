# hwkUI

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
<x-hwkui-select
    wire:model="selectedUser"
    label="Choose User"
/>

```
Make sure to include Livewire and the component's scripts on your page.

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
📧 info@osama.app

Enjoy building awesome interfaces with hwkUI! 🚀
