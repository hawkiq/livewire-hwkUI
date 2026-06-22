# 🚀 Installation

## Requirements
| Package | version |
| :--- | :--- |
|Laravel| 10+ |
|Livewire| 3+|
|tailwind| v4 |

## Install

```bash
composer require hawkiq/hwkui
```

## Publish Assets

```bash
php artisan vendor:publish --tag=hwkui-assets
```

If you updated the package you must force publish.

```bash
php artisan vendor:publish --tag=hwkui-assets --force
```

this will publish file `hwkui.css` to `resources/css/` needed to correct style widgets

add this line to `app.css` after `@import "tailwindcss";`

```css
@import './hwkui.css';
```
## Update

if you want to update use 
```bash
composer update hawkiq/hwkui
```
