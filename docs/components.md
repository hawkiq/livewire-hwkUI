# 🧩 Components

## 🧩 TomSelect

This component replaces Select2.js with a vanilla JS alternative, so it does not depend on jQuery.

- Install

!!! note "Use either CDN method or npm which described in [Configuration](configuration.md) page."

I'll use modern and prefered way in this tutorial .

```bash
npm install tom-select
```

Then, in your `app.js` import the packages:

```js title="app.js" linenums="1"
import 'tom-select/dist/css/tom-select.css';
import TomSelect from 'tom-select';
window.TomSelect = TomSelect;

```


- Basic Usage

```html
<x-hwkui-tom-select
    class="h-full"
    wire:model="customer_id"
    label="Customer"
    placeholder="Select customer...">

    <!-- Default empty option -->
    <option value="">Select Customer...</option>

    <!-- Dynamic options -->
    @foreach ($customers as $c)
        <option value="{{ (string) $c->id }}" wire:key="{{ $c->id }}">
            {{ $c->name }}
        </option>
    @endforeach

</x-hwkui-tom-select>

```

- Passing Additional TomSelect Options

You can pass extra options via the `:options` attribute:

```html
<x-hwkui-tom-select
    wire:model="customer_id"
    label="Customer"
    :options="[
        'maxItems' => 3,
        'create' => true,
        'plugins' => ['remove_button']
    ]">
</x-hwkui-tom-select>
```

More information about TomSelect setup can be found at the official website [Tom Select](https://tom-select.js.org/)

---
## 🧩 FlatPicker ( DateTime picker )


This component provides an elegant datetime picker powered by FlatPickr, ready to use in your Laravel Livewire app with a clean, customizable Blade syntax.

- Install

!!! note "Use either CDN method or npm which described in [Configuration](configuration.md) page."
I'll use modern and prefered way in this tutorial .

```bash
npm install flatpickr
```
edit `app.js`

```js  title="app.js" linenums="1"
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import monthSelectPlugin from "flatpickr/dist/plugins/monthSelect";
import "flatpickr/dist/plugins/monthSelect/style.css";
window.flatpickr = flatpickr;
window.monthSelectPlugin = monthSelectPlugin;

```


- Basic Usage

```html

<x-hwkui-flat-picker id="datetimePicker" label="Flatpicker" placeholder="Select Date" wire:model="setDatetime" />


```

 You can configure default picker options globally in  `config/hwkui.php`

```php  title="hwkui.php" linenums="1"
<?php 

'flat-picker' => [
    'defaultOptions' => [
        'enableTime' => true,
        'dateFormat' => 'Y-m-d H:i',
        'time_24hr' => true,
        'allowInput' => false,
        'altInput' => true,
        'altFormat' => 'Y-m-d H:i',
        'minuteIncrement' => 5,
    ]
],


```

You can explore all available options on the  [Options page](https://flatpickr.js.org/options/) and see what you can add.

- Override Options Per Component

to Override settings for individual instances using the `:options`  attribute:

```html

 <x-hwkui-flat-picker id="datetimePicker" label="Select Date" placeholder="Select Date" wire:model="month"
            :options="[
                'enableTime' => false,
                'dateFormat' => 'Y-m',
                'altFormat' => 'Y-m',
            ]" />

```

if you want to select only months you must then pass it as `:options` argument

```php title="hwkui.php" linenums="1"
<?php

'plugins' => [
    [
        'type' => 'monthSelect',
        'config' => [
            'shorthand' => true,
            'theme' => 'dark',
        ],
    ],
],

```

---

## 🧩 Drag & Drop File Upload


A premium, accessible, and reactive file upload component designed for Laravel, Livewire, and Tailwind CSS. It supports drag-and-drop mechanics, real-time client-side max file limitations, progress indication bars, and inline image/document previews.

---

!!! note "No setup is required since its depends on AlpineJs which comes with Livewire."

- Basic Usage

```html
<x-hwkui-upload wire:model="avatar" preview />
```

```html

<!-- Multiple Files with Previews & Constraints -->
<x-hwkui-upload 
    wire:model="documents" 
    multiple 
    max="3"  
    accept="image/*,.pdf"
    hint="Only images or PDFs are allowed. Max 3 files."
/>

```

- Component API

| Attribute | Type | Default | Description |
| :--- | :--- | :--- | :--- |
|`wire:model`|`string`|`Required`|The backing Livewire public property array/file handler string name.|
|`multiple`|`boolean`|`false`|Enables selection or dragging of multiple files simultaneously.|
|`max`|`integer`|`null`|Imposes client-side file count safety validations (works exclusively with multiple).|
|`preview`|`boolean`|`false`|Renders dynamic thumbnail galleries for images or itemized layout lists for non-images.|
|`hint`|`string|null`|`null`|Overrides the default helper sub-text positioned beneath upload prompts.|
|`accept`|`string`|`*`|Valid standard file mime-type constraint filters forwarded directly to native browser dialogs.|



---

## 🧩 Select2

- Install

!!! note "Use either CDN method or npm which described in [Configuration](configuration.md) page."
I'll use modern and prefered way in this tutorial .

```bash
npm install jquery select2
```

```js title="app.js" linenums="1"

// For select and jquery component
import $ from "jquery";
import "select2/dist/js/select2.full.min.js";
import "select2/dist/css/select2.min.css";
window.$ = $;
window.jQuery = $;
window.Select2 = $.fn.select2;
```

- Basic usgae

```html
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

```html
<x-hwkui-select
    wire:model="selectedUser"
    label="Choose User"
    :options="$options" 
>
</x-hwkui-select>

```

or direct array

```html
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

## 🧩 DateTime Picker

This component provides an elegant datetime picker powered by Tempus Dominus v6, ready to use in your Laravel Livewire app with a clean, customizable Blade syntax.

!!! danger "Developer might abandoned this Project"
    As stated in official website This project is no longer active or supported


- Install

!!! note "Use either CDN method or npm which described in [Configuration](configuration.md) page."
I'll use modern and prefered way in this tutorial .

```bash
npm install @popperjs/core @eonasdan/tempus-dominus
```

```js title="app.js" linenums="1"

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

```


- Basic Usage

```html

 <x-hwkui-datetime id="test-datetime" label="Test DateTime"
        placeholder="Select Date" wire:model="setDatetime" />

```

 You can configure default picker options globally in  `config/hwkui.php`

```php  title="hwkui.php" linenums="1"
<?php 


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

You can explore all available options on the  [Options page](https://getdatepicker.com/6/options/) and see what you can add.

- Override Options Per Component

Override settings for individual instances using the `:options`  attribute:

```html

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

## 🧩 Text Editor

A rich-text editor component powered by Quill.js, built for Laravel Livewire 3. Fully supports customization, toolbar control, themes, and Livewire model binding.
In your `config/hwkui.php`, activate the editor plugin:

```php  title="hwkui.php" linenums="1"
<?php 

'plugins' => [
    'Editor' => [
        'active' => true,
        'files' => [
            [
                'type' => 'css',
                'asset' => false,
                'location' => '//cdn.quilljs.com/1.3.6/quill.snow.css',
            ],
            [
                'type' => 'js',
                'asset' => false,
                'location' => '//cdn.quilljs.com/1.3.6/quill.min.js',
            ],
        ],
    ],
],


```

- Basic Usage

```html
<x-hwkui-editor id="editor" wire:model="content">
    Default content goes here...
</x-hwkui-editor>
```

- Toolbar Customization

Use the toolbar attribute to define your desired tools.

```html

<x-hwkui-editor id="editor"
    wire:model.live="content"
    theme="snow"
    toolbar="bold|italic|underline|link|image|code-block|blockquote|list|clean">
</x-hwkui-editor>


```
🔹 You can customize the toolbar using Quill toolbar options separated by `|`.

---

