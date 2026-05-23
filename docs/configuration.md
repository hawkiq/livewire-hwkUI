# ⚙️ Configuration
The config file `config/hwkui.php` defines which JS/CSS plugins to load and whether to use CDN or local assets or change default components options.

### 1. Publish the Config File

```bash
php artisan vendor:publish --tag=hwkui-config
```

If you published configs before and you updated the package you can force 

```bash
php artisan vendor:publish --tag=hwkui-config --force
```

This will create or update `config/hwkui.php`.

---

!!! warning "Important before use "

    Components packages must be installed or imported in order to make them works, and you have 3 ways to use them, and you are free to choose whatever suits you ( Choose one only )

## 🗂️ Using NPM Assets

If you prefer using npm packages, you can disable the plugins in the config file (set to false) and install the required packages: 

!!! note "install only the plugin you want to use "

```bash
npm install tom-select
```
```bash
npm install flatpickr
```

```bash
npm install @popperjs/core @eonasdan/tempus-dominus
```
```bash
npm install jquery select2
```


Then, in your `app.js`, import the packages:

```js title="app.js" linenums="1"

// For select and jquery component
import $ from "jquery";
import "select2/dist/js/select2.full.min.js";
import "select2/dist/css/select2.min.css";
window.$ = $;
window.jQuery = $;
window.Select2 = $.fn.select2;

// For datetime picker from tempus-dominus ( this is abandond now no new releases)
import * as Popper from "@popperjs/core";
import { TempusDominus } from "@eonasdan/tempus-dominus";
import "@eonasdan/tempus-dominus/dist/css/tempus-dominus.min.css";
window.Popper = Popper;
//use this if you used cdn assets
window.tempusDominus = TempusDominus;
// or use this if you used npm
window.tempusDominus = {
    TempusDominus,
};

// For Tom select picker which is doesn't require jquery
import 'tom-select/dist/css/tom-select.css';
import TomSelect from 'tom-select';
window.TomSelect = TomSelect;

// For FlatPickr datetime picker ( replacment for tempus-dominus) 
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import monthSelectPlugin from "flatpickr/dist/plugins/monthSelect";
import "flatpickr/dist/plugins/monthSelect/style.css";
window.flatpickr = flatpickr;
window.monthSelectPlugin = monthSelectPlugin;

```

## 🗂️ Using CDN
hwkUI uses CDN links for plugins like jQuery, Select2, and DataTables etc...

Example from `config/hwkui.php`:

```php title="hwkui.php" linenums="1"
<?php
'Select2' => [
    'active' => true, // set active to true to use CDN
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
?>
```

## 🗂️ Using Local Assets (Optional)

If you prefer to serve local assets (for offline use or better performance), follow these steps:
### Step 1: Download Required JS/CSS Files

You must download the files manually:

!!! note "Files to add manually"

    jQuery:

        https://code.jquery.com/jquery-3.7.1.min.js

    Select2:

        https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css

        https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js

Place them under `public/vendor/hwkui/` or another folder of your choice.

### Step 2: Update config/hwkui.php

Change asset => true and point to your local file path:

```php title="hwkui.php" linenums="1"
<?php 
'Select2' => [
    'active' => true,
    'files' => [
        [
            'type' => 'css',
            'asset' => true, // Set to true to use self hosted
            'location' => 'vendor/hwkui/select2.min.css',
        ],
        [
            'type' => 'js',
            'asset' => true, // Set to true to use self hosted
            'location' => 'vendor/hwkui/select2.min.js',
        ],
    ],
],

?>

```

Laravel will generate the full asset URL using `asset('vendor/hwkui/select2.min.css')`.

---

