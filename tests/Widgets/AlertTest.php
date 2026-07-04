<?php

use Hawkiq\Hwkui\View\Components\Widget\Alert;
use Illuminate\Support\Facades\Blade;

it('renders the alert component with default props and a slot', function () {
    $html = Blade::render('<x-hwkui-alert>Hi there</x-hwkui-alert>');

    expect($html)->toContain('role="alert"')
        ->and($html)->toContain('Hi there')
        ->and($html)->toContain('fa-info-circle');
});

it('renders the alert component with custom props and merges attributes', function () {
    $html = Blade::render('<x-hwkui-alert color="danger" :icon="false" animated="true" class="custom-alert" id="my-alert">Danger</x-hwkui-alert>');

    expect($html)->toContain('Danger')
        ->and($html)->toContain('custom-alert')
        ->and($html)->toContain('id="my-alert"')
        ->and($html)->toContain('role="alert"');
});

it('normalizes alert color classes and booleans', function (string $color, bool $solid, bool $animated, string $expected) {
    $component = new Alert($color, null, $animated, $solid);

    expect($component->getColorClasses())->toContain($expected)
        ->and($component->animated)->toBe($animated)
        ->and($component->solid)->toBe($solid);
})->with([
    ['primary', false, false, 'bg-blue-50'],
    ['danger', true, true, 'bg-red-600'],
]);
