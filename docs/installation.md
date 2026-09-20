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

### Publish Assets

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

## Laravel Boost Support

This package includes a dedicated **Laravel Boost skill** to help AI coding agents understand and correctly use hwkUI components, APIs, styling, Livewire integration, and package conventions.

The skill is automatically discovered by Laravel Boost when the package is installed, if not you can always use command to update skills.

```bash
php artisan boost:update
```

This allows AI agents to generate hwkUI code using the correct component names, properties, slots, semantic colors, and integration patterns.


## Helpers

if you want to use our snippets you can follow instructions in [Snippets](snippet.md)