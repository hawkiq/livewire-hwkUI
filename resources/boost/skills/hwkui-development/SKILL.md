---
name: hwkui-development
description: Build, use, debug, and modify hawkiq/hwkui Laravel Blade UI components. Use this skill whenever a task involves hwkUI components, forms, widgets, semantic colors, Jodit editor, Select/TomSelect/FlatPicker/Datetime/Upload, Accordion, Carousel, Tabs, Timeline, Card, Badge, Alert, InfoBox, SmallBox, GlassBox, Icon, Marquee, FlipCard, Tour, Typewriter, or package-specific hwkUI integration. Treat the installed package source as the source of truth and follow the exact component names, attributes, slots, color system, asset loading, Livewire binding, Alpine behavior, and Tailwind CSS v4 conventions documented here.
---

# hwkUI Development

## Purpose

`hawkiq/hwkui` is a Laravel Blade component package built for Livewire 3 and 4. It provides reusable widgets and form controls with Tailwind CSS v4, Alpine.js behavior, optional third-party JavaScript plugins, dark-mode support, and Laravel Blade component APIs.

The package namespace is:

```php
Hawkiq\Hwkui\
```

The Blade namespace is:

```text
hwkui
```

Use the package's registered aliases rather than importing package classes into application Blade views.

## Mandatory rules

1. Use hwkUI when the requested UI matches an existing hwkUI component. Do not recreate an equivalent component with raw Blade/Tailwind unless the user explicitly asks for a custom component.
2. Prefer the exact component APIs in this skill. Do not invent attributes.
3. Use kebab-case for multi-word Blade attributes:
   - `theme-mode`
   - `header-class`
   - `icon-theme`
   - `badge-color`
   - `show-controls`
   - `pause-on-hover`
   - `file-browser`
   - `connector-url`
   - `display-key`
   - `value-key`
   - `render-view`
   - `insert-view`
   - `extra-buttons`
4. Use `:` binding for arrays, collections, integers, booleans, and PHP expressions when the value must remain a PHP value.
5. Do not quote PHP expressions that are intended to be bound:
   ```blade
   :options="$options"
   :rules="$rules"
   :mentions="$users"
   :extra-buttons="$extraButtons"
   ```
6. Boolean HTML attributes are not universally equivalent to `true`. For reliable behavior, use explicit bindings when the value is dynamic:
   ```blade
   :open="true"
   :disabled="true"
   :loading="true"
   ```
   Static boolean attributes are supported by several components, but follow the component's constructor behavior.
7. Do not invent colors. Use the package semantic color system.
8. Preserve light/dark support. Do not replace package dark-mode classes with one-off light-only styles.
9. Use Tailwind CSS v4 syntax and the package's existing CSS integration. Do not introduce Tailwind v3 configuration patterns.
10. For Livewire fields, use `wire:model` on the hwkUI form component unless the component's implementation specifically requires another pattern.
11. Do not add a second JavaScript library when hwkUI already wraps the required library.
12. Before debugging a visual or JavaScript issue, verify the required plugin is actually loaded. Many hwkUI form components intentionally load their third-party asset only when the component is rendered.
13. Do not modify package internals in an application unless the user explicitly wants package customization. Prefer component attributes, configuration, published views, and application CSS where supported.
14. When modifying the package itself, inspect the existing sibling component and test conventions before creating a new pattern.
15. When documentation conflicts with executable source, executable source wins. Specifically, verify the constructor/view implementation before copying an example from older documentation.
16. Never silently change a component's public API. If an API needs correction, treat it as a package change and update its tests/docs/snippets consistently.

## Package structure

Important locations:

```text
src/
├── HwkuiServiceProvider.php
├── Helpers/PluginLoader.php
├── Support/Color.php
├── Support/TimelineContext.php
├── Http/Controllers/JoditUploaderController.php
└── View/Components/
    ├── Form/
    │   ├── Datetime.php
    │   ├── Editor.php
    │   ├── FlatPicker.php
    │   ├── PasswordStrength.php
    │   ├── Select.php
    │   ├── TomSelect.php
    │   └── Upload.php
    └── Widget/
        ├── Accordion/
        ├── Carousel/
        ├── Tabs/
        ├── Timeline/
        ├── Alert.php
        ├── Badge.php
        ├── Card.php
        ├── FlipCard.php
        ├── GlassBox.php
        ├── Icon.php
        ├── InfoBox.php
        ├── Marquee.php
        ├── SmallBox.php
        ├── Tour.php
        └── Typewriter.php

resources/
├── css/hwkui.css
└── views/
    ├── components/form/
    └── components/widget/

config/hwkui.php
routes/web.php
```

The service provider registers ordinary components under the `hwkui` namespace and registers grouped components using aliases such as `hwkui-tabs`, `hwkui-accordion`, `hwkui-carousel`, and `hwkui-timeline`.

## Installation and assets

Package installation:

```bash
composer require hawkiq/hwkui
```

The package requires Laravel 10+ and Livewire 3+. The package's Composer constraint supports:

```json
"livewire/livewire": "^3.0|^4.0"
```

The package requires Tailwind CSS v4.

Publish the package CSS:

```bash
php artisan vendor:publish --tag=hwkui-assets
```

After package updates:

```bash
php artisan vendor:publish --tag=hwkui-assets --force
```

The published `resources/css/hwkui.css` should be imported after Tailwind:

```css
@import "tailwindcss";
@import "./hwkui.css";
```

The package CSS contains Tailwind v4 `@source` directives for package Blade/PHP files and contains integration fixes for Tom Select, Select2, Flatpickr, and Jodit.

Do not remove the `@source` rules when diagnosing missing generated classes.

## Component naming

### Direct components

Use:

```blade
<x-hwkui-card />
<x-hwkui-alert />
<x-hwkui-badge />
<x-hwkui-glass-box />
<x-hwkui-icon />
<x-hwkui-info-box />
<x-hwkui-marquee />
<x-hwkui-small-box />
<x-hwkui-flip-card />
<x-hwkui-tour />
<x-hwkui-typewriter />

<x-hwkui-select />
<x-hwkui-datetime />
<x-hwkui-editor />
<x-hwkui-flat-picker />
<x-hwkui-tom-select />
<x-hwkui-upload />
<x-hwkui-password-strength />
```

### Grouped components

Use:

```blade
<x-hwkui-accordion.group />
<x-hwkui-accordion.item />
<x-hwkui-accordion.heading />
<x-hwkui-accordion.content />

<x-hwkui-carousel.wrapper />
<x-hwkui-carousel.item />

<x-hwkui-tabs.tabs />
<x-hwkui-tabs.head-wrapper />
<x-hwkui-tabs.head />
<x-hwkui-tabs.content-wrapper />
<x-hwkui-tabs.content />

<x-hwkui-timeline.timeline />
<x-hwkui-timeline.item />
<x-hwkui-timeline.indicator />
<x-hwkui-timeline.content />
<x-hwkui-timeline.title />
<x-hwkui-timeline.body />
```

Do not use guessed alternatives such as `<x-hwkui-tabs>` or `<x-hwkui-accordion>`; the grouped components are registered with dotted names.

# Semantic color system

The central source of truth is:

```php
Hawkiq\Hwkui\Support\Color
```

Supported semantic colors are:

```text
primary
success
emerald
warning
danger
info
secondary
dark
light
violet
pink
sky
```

`zinc` is also implemented internally for neutral GlassBox styling, but it is deliberately excluded from `Color::names()`.

Legacy aliases normalize to semantic names:

```text
green  -> success
blue   -> primary
amber  -> warning
red    -> danger
cyan   -> info
rose   -> pink
gray   -> secondary
```

Do not replace semantic colors with arbitrary Tailwind color names when the component exposes a semantic color prop.

Examples:

```blade
<x-hwkui-alert color="danger">
    Something went wrong.
</x-hwkui-alert>

<x-hwkui-badge color="success">
    Active
</x-hwkui-badge>

<x-hwkui-card theme="primary" theme-mode="outline">
    Content
</x-hwkui-card>
```

`Color::classes($color, $role)` provides roles including:

```text
solid
icon
soft
outline
border
text
progress
glass
glass-icon
glass-badge
```

Invalid colors generally fall back to the primary semantic styling through `Color::normalize()`, while some components explicitly use their own neutral fallback. Do not depend on invalid colors as an intentional API.

## Color-system implementation rule

When adding or modifying a component that needs a semantic color:

```php
use Hawkiq\Hwkui\Support\Color;

Color::classes($color, 'solid');
Color::classes($color, 'border');
Color::classes($color, 'text');
Color::classes($color, 'progress');
```

Do not create a new private color map in the component.

This is especially important because the package intentionally centralizes semantic colors in `Support/Color.php`.

# Direct widget APIs

## Alert

```blade
<x-hwkui-alert
    color="primary"
    icon="bell"
    :animated="false"
    :solid="false"
>
    Message
</x-hwkui-alert>
```

Constructor:

```text
color: string = primary
icon: ?string = null
animated: mixed = false
solid: mixed = false
```

Behavior:

- `solid=false` uses the semantic `soft` color role.
- `solid=true` uses the semantic `solid` color role.
- `icon=null` chooses a contextual default icon.
- `icon="false"` hides the icon.
- `animated=true` adds Font Awesome `fa-bounce`.
- Arbitrary HTML attributes/classes are merged onto the root element.

Default contextual icons include:

```text
primary/info     -> info-circle
success          -> check-circle
danger           -> exclamation-circle
warning          -> exclamation-triangle
secondary        -> bell
```

Example:

```blade
<x-hwkui-alert color="success" icon="check-circle">
    Saved successfully.
</x-hwkui-alert>
```

## Badge

```blade
<x-hwkui-badge
    variant="solid"
    color="primary"
    size="sm"
    icon="star"
>
    Label
</x-hwkui-badge>
```

Allowed variants:

```text
solid
ghost
pill
```

Allowed sizes:

```text
sm
md
lg
```

Behavior:

- `ghost` uses the semantic `soft` role.
- Other variants use the semantic `solid` role.
- `pill` changes the radius to `rounded-full`.
- Unknown sizes fall back to `sm`.

Examples:

```blade
<x-hwkui-badge>New</x-hwkui-badge>
<x-hwkui-badge variant="pill" color="violet">Featured</x-hwkui-badge>
<x-hwkui-badge variant="ghost" color="danger">Failed</x-hwkui-badge>
```

## Card

```blade
<x-hwkui-card
    title="Users"
    icon="users"
    theme="primary"
    theme-mode="outline"
>
    Content

    <x-slot name="tools">
        <button type="button">
            <x-hwkui-icon name="plus" />
        </button>
    </x-slot>

    <x-slot name="footer">
        Footer
    </x-slot>
</x-hwkui-card>
```

Props:

```text
title
icon
theme
theme-mode
header-class
body-class
footer-class
disabled
```

Important `theme-mode` behavior:

- `full`: colors the entire card using the semantic solid role.
- `outline`: adds a themed border and neutral white/dark surface.
- any other value: neutral card surface; if a theme exists, the header receives the themed background.

Slots:

```text
default slot
tools
footer
```

`disabled` displays a disabled overlay with a ban icon.

Attributes/classes are merged onto the root card element.

Do not invent a `content` or `actions` slot. Use the documented `tools` and `footer` slots.

## Flip Card

```blade
<x-hwkui-flip-card trigger="click" height="300px">
    <x-slot name="front">
        Front
    </x-slot>

    <x-slot name="back">
        Back
    </x-slot>
</x-hwkui-flip-card>
```

Props:

```text
trigger: hover|click
height: string
```

Invalid trigger values become `hover`.

Numeric height values are converted to pixels:

```text
height="300" -> 300px
```

Non-numeric values are preserved:

```text
height="20rem"
height="50vh"
```

## GlassBox

```blade
<x-hwkui-glass-box
    title="Downloads"
    :value="251"
    icon="download"
    href="/admin"
    color="emerald"
/>
```

Required:

```text
title
value
icon
```

Optional:

```text
href = #
color = zinc
```

`value` may be integer, float, or string. Numeric values are formatted with `number_format()`.

The root is an anchor and uses `wire:navigate`, so use it for internal navigable destinations when appropriate.

Unknown colors use the neutral zinc glass styling.

## Icon

The icon component is a Font Awesome wrapper.

```blade
<x-hwkui-icon name="user" />
<x-hwkui-icon name="github" type="b" />
```

Types:

```text
s / solid
b / brands
r / regular
l / light
t / thin
d / duotone
```

The component maps shorthand to Font Awesome classes:

```text
s -> fa-solid
b -> fa-brands
r -> fa-regular
l -> fa-light
t -> fa-thin
d -> fa-duotone
```

The package does not itself install Font Awesome. The application must load Font Awesome CSS.

Recommended Tailwind classes can be passed normally:

```blade
<x-hwkui-icon name="github" type="b" class="text-xl text-zinc-700 dark:text-zinc-200" />
```

## InfoBox

```blade
<x-hwkui-info-box
    title="Jobs"
    text="65/100"
    icon="tasks"
    description="65% complete"
    theme="success"
    icon-theme="success"
    :progress="65"
/>
```

Props:

```text
title
text
icon
description
url
url-target
theme
icon-theme
progress
progress-theme
```

Important behavior:

- `progress` is clamped to 0..100.
- `theme` controls the main box background.
- `icon-theme` controls the icon background.
- `progress-theme` controls the progress bar.
- Invalid `progress-theme` falls back to white.
- `url` turns the title into a link.
- `url-target` defaults to `_self`.

## SmallBox

```blade
<x-hwkui-small-box
    title="251"
    text="Users"
    icon="users"
    theme="primary"
    url="/users"
    url-text="View users"
    url-icon="arrow-right"
/>
```

Props:

```text
title
text
icon
theme
url
url-text
url-icon
loading
```

The link is rendered only when both `url` and `url-text` are present.

`loading` adds an overlay with a spinning Font Awesome icon.

## Marquee

```blade
<x-hwkui-marquee
    direction="right"
    duration="10s"
    gap="1rem"
    :pause-on-hover="true"
    :fade="true"
>
    Content
</x-hwkui-marquee>
```

Props:

```text
direction = left
duration = 20s
gap = 1rem
pause-on-hover = false
fade = false
```

Supported directions in the documented API:

```text
left
right
up
down
```

## Tour

```blade
<x-hwkui-tour
    :open="false"
    :steps="$steps"
/>
```

Props:

```text
open: bool
steps: array
```

Do not pass the steps array as a quoted string.

## Typewriter

```blade
<x-hwkui-typewriter
    :words="['Hello', 'World']"
    :type-speed="70"
    :delete-speed="35"
    :cursor="true"
    :loop="true"
    :pause-time="1500"
    :html="false"
/>
```

Props:

```text
words
type-speed
delete-speed
cursor
loop
pause-time
html
```

The PHP component casts the speed and pause values to integers and normalizes boolean values.

# Grouped widgets

## Accordion

Structure:

```blade
<x-hwkui-accordion.group
    color="primary"
    animation="slide"
    :collapse="false"
    :expanded="false"
>
    <x-hwkui-accordion.item
        heading="Question"
        icon="chevron-down"
        :disabled="false"
    >
        Answer
    </x-hwkui-accordion.item>
</x-hwkui-accordion.group>
```

Group props:

```text
animation = slide
collapse = false
color = primary
expanded = false
```

Documented animation values:

```text
slide
fade
none
```

Item props:

```text
heading
icon = chevron-down
disabled = false
```

Accordion is Alpine-powered.

`collapse=true` makes the group behave as a single-open accordion. The item uses `@aware` to inherit `color`, `animation`, and `expanded` from the group.

Do not try to implement the Alpine state in the consuming Livewire component.

`heading` is displayed in the button header. The default slot is the body.

## Carousel

Structure:

```blade
<x-hwkui-carousel.wrapper
    :items="$articles->count()"
    :interval="5000"
    :breakpoints="[
        'default' => 1,
        'sm' => 2,
        'md' => 3,
        'lg' => 4,
    ]"
    :show-controls="true"
    :show-indicators="true"
    :show-count="true"
>
    @foreach ($articles as $article)
        <x-hwkui-carousel.item>
            <!-- slide -->
        </x-hwkui-carousel.item>
    @endforeach
</x-hwkui-carousel.wrapper>
```

The actual PHP constructor is:

```php
public function __construct(
    int $items,
    int $interval = 5000,
    array $breakpoints = ['default' => 1],
    bool $showControls = true,
    bool $showIndicators = true,
    bool $showCount = true
)
```

CRITICAL: `items` is an integer count, not the collection itself. Use:

```blade
:items="$articles->count()"
```

not:

```blade
:items="$articles"
```

unless the package API is changed first.

Supported breakpoint keys in the implementation:

```text
default
sm
md
lg
```

The Alpine implementation:

- calculates visible items from `window.innerWidth`;
- automatically starts an interval when `interval > 0`;
- stops on hover;
- restarts on mouse leave;
- wraps from the last slide to the first;
- supports previous/next controls;
- supports indicators;
- supports numerical count display.

`Carousel\Item` is a pure Blade wrapper; put slide content inside it.

## Tabs

Structure:

```blade
<x-hwkui-tabs.tabs default="servers" variant="classic" color="primary">
    <x-hwkui-tabs.head-wrapper>
        <x-hwkui-tabs.head name="servers" icon="server">
            Servers
        </x-hwkui-tabs.head>

        <x-hwkui-tabs.head name="alerts" badge="2" badge-color="danger">
            Alerts
        </x-hwkui-tabs.head>
    </x-hwkui-tabs.head-wrapper>

    <x-hwkui-tabs.content-wrapper>
        <x-hwkui-tabs.content name="servers">
            Server content.
        </x-hwkui-tabs.content>

        <x-hwkui-tabs.content name="alerts">
            Alert content.
        </x-hwkui-tabs.content>
    </x-hwkui-tabs.content-wrapper>
</x-hwkui-tabs.tabs>
```

Tabs props:

```text
default = tab1
variant = classic
color = primary
```

Allowed variants:

```text
classic
pills
```

`Tabs` validates its variant and color. Invalid variants become `classic`; invalid colors become `primary`.

Head props:

```text
name: required
icon: null
badge: null
badge-color: danger
```

Content:

```text
name: required
```

The head name and content name must match exactly.

Tabs are Alpine-powered. Do not add a Livewire property merely to track the active tab unless the application needs server-side state.

## Timeline

Simple items mode:

```blade
<x-hwkui-timeline.timeline
    :items="$events"
    title-column="title"
    body-column="description"
    direction="vertical"
    color="primary"
    length="short"
/>
```

Or slot mode:

```blade
<x-hwkui-timeline.timeline direction="vertical" color="primary">
    <x-hwkui-timeline.item>
        <x-hwkui-timeline.indicator state="completed">
            <x-hwkui-icon name="check" />
        </x-hwkui-timeline.indicator>

        <x-hwkui-timeline.content>
            <x-hwkui-timeline.title>Created</x-hwkui-timeline.title>
            <x-hwkui-timeline.body>Created successfully.</x-hwkui-timeline.body>
        </x-hwkui-timeline.content>
    </x-hwkui-timeline.item>
</x-hwkui-timeline.timeline>
```

Timeline props:

```text
items = null
title-column = null
body-column = null
direction = vertical
color = primary
length = short
```

The implementation converts a truthy `items` value to a Collection.

When items mode is used, the timeline automatically generates:

- item
- indicator
- content
- title
- optional body

`direction` is intended to be:

```text
vertical
horizontal
```

Timeline context is stored in `TimelineContext` and inherited by child components when child props are omitted.

Indicator props:

```text
variant = solid
state = completed
direction = inherited when omitted
color = inherited when omitted
length = inherited when omitted
```

Indicator variant currently treats:

```text
borderless
```

specially; other values use the solid treatment.

Indicator state `last` suppresses the connecting line.

# Form components

## Select

```blade
<x-hwkui-select
    :options="$options"
    label="Status"
    placeholder="Choose one"
    wire:model="status"
/>
```

The PHP component accepts:

```text
options = []
label = null
placeholder = null
```

`options` may be an array or a JSON string. Prefer an array/PHP binding.

The component itself does not define a Livewire property. `wire:model` is passed through Blade attributes.

The Select implementation depends on its configured plugin/assets. Verify the plugin configuration before debugging JavaScript behavior.

## Datetime

```blade
<x-hwkui-datetime
    :options="$options"
    label="Date"
    placeholder="Pick a date"
    wire:model="date"
/>
```

Props:

```text
options
label
placeholder
```

The component merges user options recursively over `config('hwkui.datetime.defaultOptions')`.

Default configuration is based on Tempus Dominus.

Do not assume the package's old dependency comments imply current package recommendations. Inspect the current project/package configuration before changing the date-picker library.

## FlatPicker

```blade
<x-hwkui-flat-picker
    :options="$options"
    label="Date"
    placeholder="Pick a date"
    wire:model="date"
/>
```

Props:

```text
options
label
placeholder
```

The component merges user options recursively over:

```php
[
    'enableTime' => true,
    'dateFormat' => 'Y-m-d H:i',
    'time_24hr' => true,
    'allowInput' => false,
    'altInput' => true,
    'altFormat' => 'Y-m-d H:i',
    'minuteIncrement' => 5,
]
```

Flatpickr is the preferred newer picker in the package documentation.

## TomSelect

```blade
<x-hwkui-tom-select
    :options="$options"
    label="Tag"
    placeholder="Choose one"
    wire:model="selected"
/>
```

Props:

```text
options
label
placeholder
```

The package's CSS contains dedicated Tom Select light/dark styling and dropdown z-index fixes. Do not remove those styles when troubleshooting dropdown appearance.

## Upload

```blade
<x-hwkui-upload
    hint="Upload an image"
    :preview="true"
    :multiple="false"
    :max="2048"
    wire:model="avatar"
/>
```

Props:

```text
hint = null
preview = false
multiple = false
max = null
```

`max` is passed as a component option; do not assume a particular unit beyond what the current component/view implementation defines.

Use normal Livewire upload validation on the Livewire component.

## PasswordStrength

```blade
<x-hwkui-password-strength
    name="password"
    :checklist="true"
    :rules="[
        'length' => 8,
        'uppercase' => true,
        'lowercase' => true,
        'number' => true,
        'symbol' => true,
    ]"
/>
```

Props:

```text
name = password
checklist = true
rules = array
```

Do not pass `rules` as a quoted PHP array string.

# Jodit Editor

`<x-hwkui-editor>` is the most advanced form component.

Basic:

```blade
<x-hwkui-editor wire:model="content" />
```

Important props:

```text
id
profile
height
placeholder
language
options
file-browser
connector-url
mentions
trigger
display-key
value-key
render-callback
insert-callback
render-view
insert-view
extra-buttons
disabled
wire:model
```

The current PHP constructor uses:

```php
$id = null
$profile = null
$height = null
$placeholder = null
$language = null
$options = []
$fileBrowser = false
$connectorUrl = null
$mentions = []
$trigger = '@'
$displayKey = 'name'
$valueKey = 'id'
$renderCallback = null
$insertCallback = null
$renderView = null
$insertView = null
$extraButtons = []
```

### Editor identity

If `id` is omitted, the component generates:

```text
jodit-{hash}
```

Do not assume the generated ID is stable across requests. If external JavaScript needs a stable identifier, provide an explicit `id`.

### Editor profiles

Configured profiles are:

```text
full
simple
minimal
```

Default profile:

```text
simple
```

Use:

```blade
<x-hwkui-editor wire:model="content" profile="full" :height="500" />
```

### Custom options

Use:

```blade
<x-hwkui-editor
    wire:model="description"
    :options="[
        'toolbarAdaptive' => false,
        'showWordsCounter' => false,
    ]"
/>
```

The component merges package defaults, selected profile, height, placeholder, language, uploader settings, then instance options.

Instance options therefore have the final say when keys overlap.

### Disabled/read-only

The Blade view accepts `disabled`, and the Alpine/Jodit implementation calls:

```js
editor.setReadOnly(isDisabled)
```

Use:

```blade
<x-hwkui-editor wire:model="content" :disabled="true" />
```

### Livewire behavior

The editor uses:

```blade
@entangle($attributes->wire('model'))
```

and:

```blade
wire:ignore
```

Do not remove `wire:ignore` from the editor wrapper. The editor manages its own DOM and synchronizes its value with the Livewire model.

The editor listens for Jodit changes and updates the entangled value. It also watches the Livewire value and updates Jodit when the external value changes.

### Required JS/CSS

When using npm, Jodit must be imported into the application. The package documentation uses:

```js
import "jodit/esm/plugins/resizer/resizer";
import "jodit/esm/plugins/video/video";
import "jodit/esm/plugins/clean-html/clean-html";
import { Jodit } from "jodit";

window.Jodit = Jodit;
```

And CSS:

```css
@import "jodit/es2021/jodit";
```

Alternatively, configure the package's Editor plugin/CDN assets.

Do not load both npm and CDN Jodit implementations unless there is a deliberate reason.

### Jodit events

The package's documentation exposes:

```text
jodit:before-init
jodit:ready
```

Use the documented event contract rather than reaching into internal Alpine state.

Example:

```js
document.addEventListener('jodit:ready', (event) => {
    const { editor, Jodit } = event.detail;
});
```

### Mentions

Mentions accept arrays or Collections:

```blade
<x-hwkui-editor
    wire:model="comment"
    :mentions="$users"
    trigger="@"
    display-key="username"
/>
```

The PHP component transforms each mention item into:

```text
raw
display_html
insert_html
search_text
```

Default behavior:

- `display-key` is used for search text.
- Display HTML is escaped text unless `render-view` or `render-callback` is provided.
- Insert HTML defaults to the trigger plus escaped display value.
- `render-view` receives `$item`.
- `insert-view` receives `$item`.
- `render-callback` and `insert-callback` must be callable.

Do not put untrusted raw HTML directly into callbacks without sanitization.

### Extra editor buttons

Use:

```blade
<x-hwkui-editor
    wire:model="content"
    :extra-buttons="$extraButtons"
/>
```

A single-action button can contain:

```php
[
    'name' => 'trophy_button',
    'iconURL' => asset('images/icons/gold.webp'),
    'tooltip' => 'Insert Gold Trophy',
    'insert_html' => '<img src="/images/icons/gold.webp" alt="Gold Trophy" />',
]
```

Grid buttons can use:

```php
[
    'name' => 'emojis',
    'iconURL' => asset('images/icons/emoji_picker.png'),
    'tooltip' => 'Insert Emoji',
    'type' => 'grid',
    'items' => [
        ['name' => 'Smile', 'icon' => '😋'],
        ['name' => 'Wink', 'icon' => '😉'],
    ],
]
```

The current JavaScript implementation distinguishes:

1. `type=grid` + `items`: custom grid popup.
2. `items` without grid: Jodit list control.
3. no `items`: standard action button using `insert_html`.

Treat `insert_html` as HTML. Escape or sanitize any user-controlled content before placing it there.

# Jodit uploader

The package registers a route by default:

```text
POST/GET/etc: /jodit/connector
route name: jodit.uploader
```

Default middleware:

```text
web
auth
throttle:60,1
```

Default route configuration:

```php
'editor' => [
    'route' => [
        'enabled' => true,
        'prefix' => 'jodit',
        'name' => 'jodit.uploader',
        'middleware' => ['web', 'auth', 'throttle:60,1'],
    ],
]
```

If `editor.route.enabled` is false, the package does not automatically load its route. The application must register its own compatible route if uploads are needed.

Default uploader configuration includes:

```text
disk: public
base_path: uploads
max_file_size: 12833 KB
preserve_file_names: false
user_directory: true
```

Allowed MIME extensions currently include:

```text
jpeg
jpg
png
gif
webp
pdf
doc
docx
xls
xlsx
zip
txt
```

Do not weaken upload validation merely to make an editor upload work.

# Plugin loading

The package has a `PluginLoader` helper.

Components that require third-party assets call:

```php
PluginLoader::require('Editor');
```

The Blade plugin loader then checks:

```php
config('hwkui.plugins')
```

and loads only active plugins required by the rendered components.

The package currently defines plugin configuration for:

```text
Jquery
Select2
Datetime
Datatable
Editor
TomSelect
FlatPicker
```

A plugin can define CSS and JS files, whether they are application assets or remote locations, and whether JS should be deferred.

When a component is not working, check these in order:

1. Is the required plugin active?
2. Is the expected global JavaScript object available?
3. Is the CSS loaded?
4. Is `hwkui.css` imported?
5. Is Livewire/Alpine already loaded by the host application?
6. Is the component rendered inside a `wire:ignore` or modal context that affects the plugin?
7. Is the package's published CSS still current?

Do not immediately rewrite the component.

# Blade attributes and customization

All ordinary direct widgets merge `$attributes` onto their root elements where implemented.

Therefore this is valid:

```blade
<x-hwkui-alert class="my-6 shadow-md" color="warning">
    Warning
</x-hwkui-alert>
```

For components with custom root rendering, inspect the view before assuming attribute behavior.

Prefer passing Tailwind classes through component attributes rather than editing package source.

Use existing Tailwind v4 utilities and preserve dark-mode variants:

```blade
class="text-zinc-900 dark:text-zinc-100"
```

# Livewire integration

hwkUI is primarily a Blade component package, not a collection of Livewire components.

A Livewire component can consume hwkUI components directly:

```blade
<div>
    <x-hwkui-select
        :options="$options"
        wire:model="status"
    />

    <x-hwkui-editor wire:model="content" />
</div>
```

Do not create an unnecessary Livewire child component around every hwkUI widget.

For form controls, keep state in the consuming Livewire component:

```php
public string $status = '';
public string $content = '';
```

Validate those properties in the normal Livewire/Laravel way.

# Tailwind CSS v4 and dark mode

The package is designed for Tailwind CSS v4.

Do not add:

```text
tailwind.config.js
@tailwind base;
@tailwind components;
@tailwind utilities;
```

just to make hwkUI work in a Tailwind v4 project.

Use:

```css
@import "tailwindcss";
@import "./hwkui.css";
```

The package itself uses `@source` directives to expose component classes to Tailwind v4.

Preserve the package's `dark:` or `html.dark` behavior when adding styles.

When creating application-specific surrounding UI, prefer the same neutral palette used by hwkUI:

```text
zinc
slate
gray
```

and use semantic hwkUI colors for component-level themes.

# Common mistakes to avoid

## Mistake: passing a Carousel collection to `items`

Wrong:

```blade
<x-hwkui-carousel.wrapper :items="$articles">
```

The current constructor requires `int`.

Correct:

```blade
<x-hwkui-carousel.wrapper :items="$articles->count()">
```

## Mistake: inventing component names

Wrong:

```blade
<x-hwkui-tabs />
<x-hwkui-accordion />
<x-hwkui-timeline />
```

Correct grouped names:

```blade
<x-hwkui-tabs.tabs />
<x-hwkui-accordion.group />
<x-hwkui-timeline.timeline />
```

## Mistake: inventing color maps

Wrong:

```php
$colors = [
    'primary' => 'bg-blue-500',
    ...
];
```

Correct:

```php
Color::classes($color, 'solid');
```

## Mistake: using raw JSON strings for arrays

Avoid:

```blade
rules="{'length': 8}"
```

Prefer:

```blade
:rules="['length' => 8]"
```

## Mistake: removing `wire:ignore` from Jodit

Do not remove the editor's `wire:ignore`.

## Mistake: forgetting Font Awesome

`x-hwkui-icon` generates Font Awesome classes. If Font Awesome CSS is not loaded, icons will not display.

## Mistake: forgetting the package CSS

If widgets look unstyled or Tailwind classes appear missing:

```bash
php artisan vendor:publish --tag=hwkui-assets --force
```

and ensure:

```css
@import "tailwindcss";
@import "./hwkui.css";
```

## Mistake: loading a plugin manually without checking configuration

The package already has a plugin loader. First inspect `config/hwkui.php`.

## Mistake: treating documentation snippets as executable contracts

The repository contains older examples and documentation. When an example conflicts with the constructor or view, follow the actual PHP/Blade implementation.

Known example/API mismatch:

```blade
:items="$articles"
```

for Carousel conflicts with the current constructor:

```php
public function __construct(int $items, ...)
```

Use the integer count.

# Package modification workflow

When changing hwkUI itself:

1. Inspect the existing component PHP class.
2. Inspect its Blade view.
3. Inspect the nearest related component.
4. Reuse `Color` and existing helpers instead of duplicating behavior.
5. Check grouped component context such as `@aware` and `TimelineContext`.
6. Check the published CSS and Tailwind v4 `@source` rules if CSS classes are involved.
7. Update or add Pest tests.
8. Update the relevant documentation.
9. Update `.vscode/package.code-snippets` when a public component API changes.
10. Run formatting:
   ```bash
   composer format
   ```
11. Run tests:
   ```bash
   composer test
   ```
12. Run static analysis:
   ```bash
   composer analyse
   ```

Do not make unrelated refactors during a component change.

# Testing guidance

The package uses Pest and Orchestra Testbench.

Existing test areas include:

```text
tests/ColorSystemTest.php
tests/ComponentTest.php
tests/Widgets/AccordionAndCarouselTest.php
tests/Widgets/AlertTest.php
tests/Widgets/BadgeTest.php
tests/Widgets/CardTest.php
tests/Widgets/OtherWidgetsTest.php
tests/Widgets/TabsAndTimelineTest.php
```

For a new widget, test at minimum:

- component renders;
- default props;
- important prop variations;
- semantic color behavior;
- invalid/fallback values where the component explicitly supports them;
- slots;
- attribute/class merging;
- Livewire behavior when the component is a form control.

For color changes, test the centralized `Color` class and representative component output rather than duplicating huge expected maps in every widget test.

# Snippet conventions

The package includes `.vscode/package.code-snippets`.

The snippet prefix follows:

```text
hwk-<component>
```

Examples:

```text
hwk-alert
hwk-badge
hwk-card
hwk-select
hwk-datetime
hwk-editor
hwk-flat-picker
hwk-tom-select
hwk-upload
hwk-tabs
hwk-timeline
```

When changing a component's public API, update its snippet so the snippet demonstrates the current API.

Do not copy a snippet blindly if the snippet conflicts with the current PHP constructor.

# Decision procedure for AI agents

When a user asks for UI:

1. Identify whether an existing hwkUI component matches.
2. If yes, use it directly.
3. Determine whether it is a direct or grouped component.
4. Check the exact constructor/API in this skill.
5. Check whether a third-party plugin is required.
6. If it is a form control, connect it to Livewire with `wire:model`.
7. If it uses colors, use semantic colors.
8. If it is an array/collection prop, use `:` binding.
9. If it needs dark mode, preserve `dark:` styles.
10. Only fall back to custom Blade/Tailwind when hwkUI does not provide the requested behavior.

When debugging:

1. Reproduce the smallest component example.
2. Inspect the rendered HTML and browser console.
3. Verify package CSS.
4. Verify plugin loading.
5. Verify Livewire/Alpine initialization.
6. Compare the application's usage with the actual component constructor and Blade view.
7. Only then modify code.

When modifying the package:

1. Keep the public API stable unless explicitly changing it.
2. Reuse existing abstractions.
3. Centralize semantic colors.
4. Preserve accessibility attributes already present.
5. Preserve RTL behavior where existing views implement it.
6. Preserve `wire:navigate` where the component intentionally uses it.
7. Preserve `wire:ignore` for externally managed editors.
8. Add tests for behavior, not implementation details alone.

# Quick reference

```text
Direct widgets:
x-hwkui-alert
x-hwkui-badge
x-hwkui-card
x-hwkui-flip-card
x-hwkui-glass-box
x-hwkui-icon
x-hwkui-info-box
x-hwkui-marquee
x-hwkui-small-box
x-hwkui-tour
x-hwkui-typewriter

Form:
x-hwkui-select
x-hwkui-datetime
x-hwkui-editor
x-hwkui-flat-picker
x-hwkui-tom-select
x-hwkui-upload
x-hwkui-password-strength

Grouped:
x-hwkui-accordion.group
x-hwkui-accordion.item
x-hwkui-accordion.heading
x-hwkui-accordion.content

x-hwkui-carousel.wrapper
x-hwkui-carousel.item

x-hwkui-tabs.tabs
x-hwkui-tabs.head-wrapper
x-hwkui-tabs.head
x-hwkui-tabs.content-wrapper
x-hwkui-tabs.content

x-hwkui-timeline.timeline
x-hwkui-timeline.item
x-hwkui-timeline.indicator
x-hwkui-timeline.content
x-hwkui-timeline.title
x-hwkui-timeline.body
```

The package is Blade-first. Use its components as reusable primitives inside Laravel and Livewire views, keep state in the consuming application, and rely on the centralized hwkUI color and plugin systems rather than recreating them.
