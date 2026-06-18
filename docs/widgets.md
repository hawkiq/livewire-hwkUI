# 🧩 Widgets

## 📦 Card Widget
A reusable friendly Card component built with Tailwind CSS v4, part of the hawkiq/hwkui widget library. It supports theme colors, outline and solid styles, optional icons, header tools, footer, and dark mode.

![Card Widget](assets/card-widget.PNG)

###  Basic Usage

```html
    <x-hwkui-card title="Users" icon="fas fa-users" theme="primary">
        Basic Card Usage

        <x-slot name="tools">
            <button class="cursor-pointer text-white hover:text-gray-200">
                <i class="fas fa-plus"></i>
            </button>
            <button class="cursor-pointer text-white hover:text-gray-200">
                <i class="fas fa-cog"></i>
            </button>
        </x-slot>
        <x-slot name="footer">
            Card Footer
        </x-slot>
    </x-hwkui-card>


    <x-hwkui-card theme="danger" theme-mode="outline">
        A card without header has red border ...
    </x-hwkui-card>

    <x-hwkui-card icon="fas fa-cog" title="No theme-mode" theme="warning" disabled>
        A card with header using warning color but disabled...
    </x-hwkui-card>

    <x-hwkui-card icon="fas fa-cog" title="Full Theme Mode" theme="success" theme-mode="full">
        A card with full color...
    </x-hwkui-card>

```

## 📦 Info Box Widget
For display small infos with icons or progress bar

![Info Box Widget](assets/info-box-widget.PNG)
###  Basic Usage

```html
    <x-hwkui-info-box title="Users" text="251" icon="fas fa-users" iconTheme="primary"
        description="251 Users Registered" url="https://osama.app" urlTarget="_blank" />

    <x-hwkui-info-box title="CPU Traffic" text="60%" icon="fas fa-cog" theme="warning" iconTheme="warning" />

    <x-hwkui-info-box title="Test with no colors" text="No Colors" icon="fas fa-vials" />

    <x-hwkui-info-box title="Downloads" text="3652" icon="fas fa-download" theme="primary" iconTheme="primary" />

    <x-hwkui-info-box title="Uploads" text="1987" icon="fas fa-upload" theme="danger" iconTheme="danger" />

    <x-hwkui-info-box title="Jobs" text="65/100" description="65% of the jobs finished" icon="fas fa-tasks"
        theme="success" iconTheme="success" progress="65" />

```

## 📦 Small Box Widget
For display one info with beautiful UI

![Info Box Widget](assets/small-box-widget.PNG)
### Basic Usage

```html

<x-hwkui-small-box title="251" text="Users" icon="fas fa-users" theme="primary" url="https://osama.app"
            urlText="View all users" urlIcon="fas fa-link" />

        <x-hwkui-small-box title="Loading" text="Loading data..." icon="fas fa-tasks" theme="success"
            url="https://osama.app" urlText="More info" urlIcon="fas fa-link" loading="true" />

        <x-hwkui-small-box title="424" text="Views" icon="fas fa-eye" theme="danger"
            url="https://osama.app" urlText="View details" urlIcon="fas fa-link" />

        <x-hwkui-small-box title="Downloads" text="1205" icon="fas fa-download" />

```

## 📦 Glass Box Widget
For display small infos with icons with Glass look 

![Glass Box Widget](assets/glass-box-widget.PNG)
###  Basic Usage

```html
     <x-hwkui-glass-box title="Downloads" value="251" icon="fa-download" href="/admin"
            color="blue" />

        <x-hwkui-glass-box title="Products" :value="700" icon="fa-cog" href="/admin" color="emerald" />

        <x-hwkui-glass-box title="Categories" :value="30" icon="fa-list" href="/admin" color="amber" />

```
Supported colors names same as tailwind `(blue-amber-emerald-red-cyan-violet)`

---

## 📦 Timeline Widget

A versatile, highly configurable, dynamic timeline component for Laravel Blade applications built with Tailwind CSS. It supports vertical/horizontal flows, automated collection mapping, and complete granular slot overrides.

![Timeline Widget](assets/timeline-widget.PNG)

---

### Component API Reference

`<x-hwkui-timeline.timeline>`
The main layout wrapper that handles orientation and sets the global design context.

| Attribute | Type | Default | Description |
| :--- | :--- | :--- | :--- |
| `items` | `Collection\|array\|null` | `null` | Passing data into this unlocks automated loop mapping. |
| `title-column` | `string\|null` | `null` | Key name to fetch the title from items. |
| `body-column` | `string\|null` | `null` | Key name to fetch description body from items. |
| `direction` | `string` | `'vertical'` | `'vertical'` or `'horizontal'` structural rendering. |
| `color` | `string` | `'primary'` | Sets global theme color for indicators and lines. |

`<x-hwkui-timeline.indicator>`
The timeline hub point containing indicators and dynamic milestone bridge lines.

| Attribute | Type | Default | Description |
| :--- | :--- | :--- | :--- |
| `variant` | `string` | `'solid'` | `'solid'` (filled badge background) or `'borderless'`. |
| `state` | `string` | `'completed'` | Passing `'last'` breaks structural tracking and safely terminates lines. |
| `color` | `string\|null` | `null` | Pulls context theme; passing values explicitly overrides individual instances. |

---

### Supported Color Themes
Your system comes with modern built-in palettes. Customizing colors sets consistent backgrounds, boundaries, and texts:

- `primary` (🔵)
- `success` (🟢)
- `danger` (🔴)
- `warning` (🟡)
- `pink`  (🌸)
- `violet`  (🟣)
- `gray`  (⚫)
- `emerald`  (💚)
- `sky`  (🌐)
- `dark`  (🌗) (Automatic Light-to-Dark inversion support using standard class

---

### Basic Usage

- Simple Version (Automated Collection Rendering)
When you pass an absolute collection data object into the `:items` array attribute, the timeline component handles all inner loops, mapping, checkmark icon injections, and terminates trailing lines flawlessly without extra layout markup.

```html
<x-hwkui-timeline.timeline 
    :items="$users" 
    title-column="name" 
    body-column="email" 
    direction="horizontal" 
    color="success" 
/>

```


- Customized Version

For granular layouts, omit the `:items` attribute. You gain full creative authority to use conditional blade assertions inside, modify individual milestone theme colors, toggle distinct custom icons, or switch presentation variants.

!!! warning "Crucial Rule for Manual Loops"

    You must provide :state="$loop->last ? 'last' : 'completed'" or state="last" to your inner indicator so that the trailing line safely clips off at the end of your tracking row!

```html
<x-hwkui-timeline.timeline direction="vertical" color="primary">
    @foreach ($users as $user)
        <x-hwkui-timeline.item>
            
            <x-hwkui-timeline.indicator 
                :state="$loop->last ? 'last' : 'completed'" 
                :color="$user->hasRole('admin') ? 'danger' : null"
                variant="solid"
            >
                <i class="fas fa-{{ $user->hasRole('admin') ? 'shield-alt' : 'user' }}"></i>
            </x-hwkui-timeline.indicator>
            
            <x-hwkui-timeline.content>
                <x-hwkui-timeline.title>
                    {{ $user->name }} 
                    <span class="text-xs text-gray-400">({{ $user->username }})</span>
                </x-hwkui-timeline.title>
                
                <x-hwkui-timeline.body>
                    {{ $user->roles->pluck('display_name')->join(', ') }}
                </x-hwkui-timeline.body>
            </x-hwkui-timeline.content>

        </x-hwkui-timeline.item>
    @endforeach
</x-hwkui-timeline.timeline>

```

---

## 📦 Icon Widget
The Icon component provides a clean shorthand syntax for rendering Font Awesome icons. It automatically handles structural classes, provides simple shorthand flags for icon weights, and seamlessly merges any custom Tailwind utility classes.
---

### Component API

| Attribute | Type | Default | Description |
| :--- | :--- | :--- | :--- |
| `icon` | `string` | *Required* | The name of the Font Awesome icon (e.g., `"user"`, `"github"`). |
| `type` | `string` | `"s"` | The weight/type variant. Accepts shorthands (`s`, `b`, `r`, `l`, `t`, `d`) or full names. |

#### Weight Shorthand Matrix
* `s` / `solid` → `fa-solid`
* `b` / `brands` → `fa-brands`
* `r` / `regular` → `fa-regular`
* `l` / `light` → `fa-light`
* `t` / `thin` → `fa-thin`
* `d` / `duotone` → `fa-duotone`

### Basic Usage

#### Basic Solid Icon
```html
<x-hwkui-icon icon="user" />
```

#### Brand Icon with Color Utilities
```html
<x-hwkui-icon icon="github" type="b" class="text-gray-900 text-xl" />
```

---


## 📦 Alert Widget

A modern, accessible notification banner component designed for Tailwind CSS v4. It supports multiple contextual color themes, customizable embedded icons, smart defaults, and decorative entrance animations.

![Alert Widget](assets/alert-widget.PNG)

---

### Component API
| Attribute | Type | Default | Description |
| :--- | :--- | :--- | :--- |
|`color`	|`string`	|`primary`	|Component color theme. Supports: primary, secondary, success, danger, warning, info, violet, pink.|
|`icon`	| `string\|null`	| `Auto`	|Overrides the contextual default icon. Set to "false" to hide the icon area completely.|
|`animated`	|`boolean\|string`	| `false`	| When true, applies an active bounce physics effect to the icon element.|


### Basic Usage

```html
<x-hwkui-alert color="danger">
    Something went wrong! Please try re-submitting the form.
</x-hwkui-alert>

Custom Icon & Animation

<x-hwkui-alert color="success" icon="cake-candles" animated="true">
    Your account registration is officially complete!
</x-hwkui-alert>

Modern Accent Colors (Violet)

<x-hwkui-alert color="violet" icon="sparkles">
    New feature unlocked! Explore your new personalized dashboard.
</x-hwkui-alert>

Text-Only Mode (Hidden Icon)

<x-hwkui-alert color="secondary" icon="false">
    Maintenance window scheduled tonight between 2:00 AM and 4:00 AM UTC.
</x-hwkui-alert>

Appending Utility Classes

<x-hwkui-alert color="warning" class="my-6 shadow-md border-dashed">
    Your subscription expires in 3 days. Please renew your plan.
</x-hwkui-alert>

```

## 📦 Badge Widget

The Badge component is a flexible, highly customizable widget used to highlight statuses, counts, labels, or indicators. It supports multiple shape variants, built-in color themes (with full dark mode support), multiple sizing options, and automated icon prefix injection.

![Badge Widget](assets/badge-light.PNG)

![Badge Widget](assets/badge-dark.PNG)

---

### Basic Usage

```html
<x-hwkui-badge variant="solid" color="primary">Solid Badge</x-hwkui-badge>

<x-hwkui-badge variant="pill" color="violet">Pill Badge</x-hwkui-badge>

<x-hwkui-badge variant="ghost" color="pink">Ghost Badge</x-hwkui-badge>

<x-hwkui-badge size="sm" icon="star">Small</x-hwkui-badge>

<x-hwkui-badge size="md" icon="star">Medium</x-hwkui-badge>

<x-hwkui-badge size="lg" icon="star">Large</x-hwkui-badge>


```

### Component API

| Attribute | Type | Default | Allowed Values | Description |
| :--- | :--- | :--- | :--- | :--- |
|`variant`|`string`|`solid`|`solid \| ghost \| pill`|Defines the background/border style of the badge.|
|`color`|`string`,|`primary`|`primary, secondary, success, emerald, danger, warning, info, violet, pink, dark, light`|Sets the visual theme color (supports dark mode out-of-the-box).|
|`size`|`string`|`sm`|`sm \| md \| lg`|Modifies the font-size, padding, and internal icon scaling.|
|`icon`|`string`|`null`|Font Awesome icon name (e.g., `bell`, `star`, `check`)|Automatically prepends the <x-hwkui-icon> component inside the badge.|

---

