<?php

use Hawkiq\Hwkui\Support\Color;
use Hawkiq\Hwkui\View\Components\Widget\Alert;
use Hawkiq\Hwkui\View\Components\Widget\Badge;
use Hawkiq\Hwkui\View\Components\Widget\Card;
use Hawkiq\Hwkui\View\Components\Widget\GlassBox;
use Hawkiq\Hwkui\View\Components\Widget\InfoBox;
use Illuminate\Support\Facades\Blade;

function supportedColors(): array
{
    return [
        'primary', 'success', 'warning', 'danger', 'info', 'pink',
        'violet', 'secondary', 'dark', 'light', 'emerald', 'sky',
    ];
}

it('defines complete shared roles for every public semantic color', function (string $color) {
    foreach (['solid', 'soft', 'outline', 'text', 'border', 'progress', 'icon', 'glass', 'glass-icon', 'glass-badge'] as $role) {
        expect(Color::classes($color, $role))
            ->not->toBe('');
    }

    expect(Color::supports($color))->toBeTrue();
})->with(fn () => supportedColors());

it('applies every public semantic color through component integrations', function (string $color) {
    $badge = new Badge('solid', $color);
    $ghostBadge = new Badge('ghost', $color);
    $alert = new Alert($color, null, false, true);
    $softAlert = new Alert($color);
    $card = new Card(theme: $color, themeMode: 'full');
    $infoBox = new InfoBox(theme: $color, progressTheme: $color);
    $glassBox = new GlassBox('Metric', 10, 'chart-line', '#', $color);

    expect($badge->getColorClasses())->toContain(Color::classes($color, 'solid'))
        ->and($ghostBadge->getColorClasses())->toContain(Color::classes($color, 'soft'))
        ->and($alert->getColorClasses())->toContain(Color::classes($color, 'solid'))
        ->and($softAlert->getColorClasses())->toContain(Color::classes($color, 'soft'))
        ->and($card->bgColor())->toContain(Color::classes($color, 'solid'))
        ->and($card->borderColor())->toContain(Color::classes($color, 'border'))
        ->and($infoBox->progressBarClasses())->toBe(Color::classes($color, 'progress'))
        ->and($glassBox->cardClasses())->toContain(Color::classes($color, 'glass'));
})->with(fn () => supportedColors());

it('preserves badge variants, case normalization, external classes, and fallback behavior', function () {
    $solid = new Badge('solid', 'PRIMARY');
    $ghost = new Badge('ghost', 'Success');
    $pill = new Badge('pill', 'DANGER');
    $fallback = new Badge('solid', 'does-not-exist');
    $html = Blade::render('<x-hwkui-badge color="success" variant="ghost" class="custom-class">Ready</x-hwkui-badge>');

    expect($solid->color)->toBe('primary')
        ->and($solid->getColorClasses())->toContain(Color::classes('primary', 'solid'))
        ->and($ghost->color)->toBe('success')
        ->and($ghost->getColorClasses())->toContain(Color::classes('success', 'soft'))
        ->and($pill->variant)->toBe('pill')
        ->and($pill->getShapeClasses())->toContain('rounded-full')
        ->and($pill->getColorClasses())->toContain(Color::classes('danger', 'solid'))
        ->and($fallback->getColorClasses())->toContain(Color::classes('primary', 'solid'))
        ->and($html)->toContain('custom-class')
        ->and($html)->toContain('bg-green-50')
        ->and($html)->toContain('dark:bg-green-950/40');
});

it('retains component-specific fallbacks while using shared known colors', function () {
    $infoBox = new InfoBox(theme: 'unknown', iconTheme: 'unknown', progressTheme: 'unknown');
    $card = new Card(theme: 'unknown', themeMode: 'full');
    $glassBox = new GlassBox('Metric', 10, 'chart-line', '#', 'unknown');

    expect($infoBox->bgColor())->toBe('bg-white')
        ->and($infoBox->iconBgColor())->toBe('bg-gray-400')
        ->and($infoBox->progressBarClasses())->toBe('bg-white')
        ->and($card->bgColor())->toBe('bg-zinc-200 dark:bg-zinc-900')
        ->and($card->borderColor())->toBe('border-gray-300')
        ->and($glassBox->cardClasses())->toContain('bg-zinc-50 dark:bg-zinc-900/30');
});

it('renders shared colors in Tabs, Accordion, and Timeline Blade components', function (string $color) {
    $tabs = Blade::render(
        '<x-hwkui-tabs.tabs color="'.$color.'"><x-hwkui-tabs.head name="one">One</x-hwkui-tabs.head></x-hwkui-tabs.tabs>'
    );
    $accordion = Blade::render(
        '<x-hwkui-accordion.group color="'.$color.'"><x-hwkui-accordion.item heading="Section">Content</x-hwkui-accordion.item></x-hwkui-accordion.group>'
    );
    $timeline = Blade::render(
        '<x-hwkui-timeline.timeline color="'.$color.'"><x-hwkui-timeline.indicator color="'.$color.'" variant="borderless">1</x-hwkui-timeline.indicator></x-hwkui-timeline.timeline>'
    );

    expect($tabs)->toContain(Color::classes($color, 'solid'))
        ->and($accordion)->toContain(Color::classes($color, 'solid'))
        ->and($accordion)->toContain(Color::classes($color, 'border'))
        ->and($timeline)->toContain(Color::classes($color, 'progress'))
        ->and($timeline)->toContain(Color::classes($color, 'text'));
})->with(fn () => supportedColors());
