<?php

use Hawkiq\Hwkui\View\Components\Widget\Tabs\Tabs;
use Illuminate\Support\Facades\Blade;

it('renders tabs with a default active tab and propagates attributes', function () {
    $html = Blade::render('<x-hwkui-tabs.tabs default="second" class="custom-tabs"><x-hwkui-tabs.head name="first">First</x-hwkui-tabs.head><x-hwkui-tabs.head name="second">Second</x-hwkui-tabs.head></x-hwkui-tabs.tabs>');

    expect($html)->toContain('hwkui-tabs')
        ->and($html)->toContain('custom-tabs')
        ->and($html)->toContain('Second');
});

it('renders a timeline from an items collection and a slot fallback', function () {
    $items = [['title' => 'One', 'body' => 'Alpha'], ['title' => 'Two', 'body' => 'Beta']];
    $timelineHtml = Blade::render('<x-hwkui-timeline.timeline :items="$items" title-column="title" body-column="body" />', ['items' => $items]);
    $fallbackHtml = Blade::render('<x-hwkui-timeline.timeline><span>Fallback</span></x-hwkui-timeline.timeline>');

    expect($timelineHtml)->toContain('hwkui-timeline')
        ->and($timelineHtml)->toContain('One')
        ->and($timelineHtml)->toContain('Alpha')
        ->and($fallbackHtml)->toContain('Fallback');
});

it('falls back to safe values for invalid badge and tabs props', function () {
    $badge = new \Hawkiq\Hwkui\View\Components\Widget\Badge('ghostly', 'unknown', 'xl', 'check');
    $tabs = new Tabs(default: 'tab1', variant: 'invalid', color: 'unknown');

    expect($badge->getShapeClasses())->toContain('rounded')
        ->and($badge->getColorClasses())->toContain('bg-blue-600')
        ->and($tabs->variant)->toBe('classic')
        ->and($tabs->color)->toBe('primary');
});
