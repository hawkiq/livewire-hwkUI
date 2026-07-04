<?php

use Hawkiq\Hwkui\View\Components\Widget\FlipCard;
use Hawkiq\Hwkui\View\Components\Widget\GlassBox;
use Hawkiq\Hwkui\View\Components\Widget\Icon;
use Hawkiq\Hwkui\View\Components\Widget\InfoBox;
use Hawkiq\Hwkui\View\Components\Widget\Marquee;
use Hawkiq\Hwkui\View\Components\Widget\SmallBox;
use Hawkiq\Hwkui\View\Components\Widget\Typewriter;
use Illuminate\Support\Facades\Blade;

it('renders the flip card widget with the expected alpine bindings and slot content', function () {
    $html = Blade::render('<x-hwkui-flip-card trigger="click" height="320px"><x-slot name="front">Front</x-slot><x-slot name="back">Back</x-slot></x-hwkui-flip-card>');
    $component = new FlipCard('click', '320px');

    expect($html)->toContain('x-data')
        ->and($html)->toContain('Front')
        ->and($html)->toContain('Back')
        ->and($component->trigger)->toBe('click')
        ->and($component->height)->toBe('320px');
});

it('renders the glass box widget with calculated classes and formatted value', function () {
    $component = new GlassBox('Revenue', 1234.5, 'chart-line', '#', 'blue');
    $html = Blade::render('<x-hwkui-glass-box title="Revenue" :value="1234.5" icon="chart-line" href="#" color="blue" />');

    expect($component->formattedValue())->toBe('1,235')
        ->and($component->cardClasses())->toContain('bg-blue-100')
        ->and($html)->toContain('Revenue')
        ->and($html)->toContain('1,235');
});

it('renders the icon widget with the mapped font awesome class', function () {
    $component = new Icon('check', 'r');
    $html = Blade::render('<x-hwkui-icon name="check" type="r" />');

    expect($component->type)->toBe('fa-regular')
        ->and($html)->toContain('fa-check')
        ->and($html)->toContain('fa-regular');
});

it('renders the info box widget and clamps progress values', function () {
    $component = new InfoBox('Sales', '120', 'chart-bar', 'Updated', '#', '_blank', 'primary', 'secondary', 150, 'danger');
    $html = Blade::render('<x-hwkui-info-box title="Sales" text="120" icon="chart-bar" description="Updated" url="#" url-target="_blank" theme="primary" icon-theme="secondary" :progress="150" progress-theme="danger" />');

    expect($component->progress)->toBe(100)
        ->and($component->boxClasses())->toContain('bg-blue-600')
        ->and($component->progressBarClasses())->toBe('bg-red-600')
        ->and($html)->toContain('Sales')
        ->and($html)->toContain('Updated');
});

it('renders the marquee widget with its duplicate content wrapper', function () {
    $component = new Marquee('right', '12s', '1.5rem', true, true);
    $html = Blade::render('<x-hwkui-marquee direction="right" duration="12s" gap="1.5rem" pause-on-hover fade><span>Loop</span></x-hwkui-marquee>');

    expect($component->direction)->toBe('right')
        ->and($html)->toContain('hwkui-pause-on-hover')
        ->and($html)->toContain('Loop');
});

it('renders the small box widget and exposes its helper classes', function () {
    $component = new SmallBox('Revenue', '12k', 'chart-line', 'primary', '#', 'View', 'arrow-right', false);
    $html = Blade::render('<x-hwkui-small-box title="Revenue" text="12k" icon="chart-line" theme="primary" url="#" url-text="View" url-icon="arrow-right" />');

    expect($component->boxClasses())->toContain('bg-blue-600')
        ->and($component->bgColor())->toContain('bg-blue-600')
        ->and($html)->toContain('Revenue')
        ->and($html)->toContain('View');
});

it('renders the typewriter widget with custom props and the expected alpine markup', function () {
    $component = new Typewriter(['Hello', 'World'], 120, 35, false, true, 1500);
    $html = Blade::render('<x-hwkui-typewriter :words="[\'Hello\', \'World\']" type-speed="120" delete-speed="35" :cursor="false" :loop="true" pause-time="1500" />');

    expect($component->words)->toBe(['Hello', 'World'])
        ->and($component->typeSpeed)->toBe(120)
        ->and($html)->toContain('x-data')
        ->and($html)->toContain('x-text="text"');
});
