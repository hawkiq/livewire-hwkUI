# 🚀 hwkUI VS Code Snippets

## Per-project installation

The package already includes a workspace snippet file at [.vscode/package.code-snippets](code-snippets.md).

1. Open the workspace root in VS Code.
2. The snippets will be available automatically for that project.

## Installation

Copy the generated file into your VS Code user snippets folder or use the workspace version in [.vscode/package.code-snippets](code-snippets.md).

## Global installation for all projects

On macOS, place the file in this user snippets folder:

```bash
mkdir -p ~/Library/Application\ Support/Code/User/snippets
cp .vscode/package.code-snippets ~/Library/Application\ Support/Code/User/snippets/package.code-snippets
```

Then reload VS Code or run the command "Developer: Reload Window".

## Verify the installation

Open a Blade or PHP file and start typing one of the prefixes such as `hwk-alert`, `hwk-card` or `hwk-styles`.


## Summary Table

| Component/Feature Name | Snippet Prefix | Description | 
| --- | --- | --- |
| Alert | `hwk-alert` | Insert a hwkUI alert component. | 
| Badge | `hwk-badge` | Insert a hwkUI badge component. | 
| Card | `hwk-card` | Insert a hwkUI card component. | 
| Flip Card | `hwk-flip-card` | Insert a hwkUI flip card component. | 
| Glass Box | `hwk-glass-box` | Insert a hwkUI glass box statistic widget. | 
| Icon | `hwk-icon` | Insert a hwkUI icon component. | 
| Info Box | `hwk-info-box` | Insert a hwkUI info box component. | 
| Marquee | `hwk-marquee` | Insert a hwkUI marquee component. | 
| Small Box | `hwk-small-box` | Insert a hwkUI small box component. | 
| Tour | `hwk-tour` | Insert a hwkUI tour component. | 
| Typewriter | `hwk-typewriter` | Insert a hwkUI typewriter component. | 
| Accordion Group | `hwk-acc-group` | Insert a hwkUI accordion group container. | 
| Accordion Item | `hwk-acc-item` | Insert a hwkUI accordion item. | 
| Accordion Heading | `hwk-acc-heading` | Insert a hwkUI accordion heading. | 
| Accordion Content | `hwk-acc-content` | Insert a hwkUI accordion content block. | 
| Carousel Wrapper | `hwk-carousel` | Insert a hwkUI carousel wrapper. | 
| Carousel Item | `hwk-carousel-item` | Insert a hwkUI carousel item. | 
| Tabs | `hwk-tabs` | Insert a hwkUI tabs container. | 
| Tabs Head Wrapper | `hwk-tab-head-wrap` | Insert a hwkUI tabs head wrapper. | 
| Tabs Head | `hwk-tab-head` | Insert a hwkUI tabs head trigger. | 
| Tabs Content Wrapper | `hwk-tab-content-wrap` | Insert a hwkUI tabs content wrapper. | 
| Tabs Content | `hwk-tab-content` | Insert a hwkUI tabs content panel. | 
| Timeline | `hwk-timeline` | Insert a hwkUI timeline container. | 
| Timeline Item | `hwk-timeline-item` | Insert a hwkUI timeline item. | 
| Timeline Indicator | `hwk-timeline-indicator` | Insert a hwkUI timeline indicator. | 
| Timeline Content | `hwk-timeline-content` | Insert a hwkUI timeline content block. | 
| Timeline Title | `hwk-timeline-title` | Insert a hwkUI timeline title block. | 
| Timeline Body | `hwk-timeline-body` | Insert a hwkUI timeline body block. | 
| Select | `hwk-select` | Insert a hwkUI select component. | 
| Datetime | `hwk-datetime` | Insert a hwkUI datetime picker component. | 
| Editor | `hwk-editor` | Insert a hwkUI rich text editor component. | 
| Flat Picker | `hwk-flat-picker` | Insert a hwkUI flat picker component. | 
| Tom Select | `hwk-tom-select` | Insert a hwkUI Tom Select component. | 
| Upload | `hwk-upload` | Insert a hwkUI upload component. | 
| Password Strength | `hwk-password-strength` | Insert a hwkUI password strength checker. | 



