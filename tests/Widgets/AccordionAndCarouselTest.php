<?php

use Hawkiq\Hwkui\View\Components\Widget\Accordion\Group;
use Hawkiq\Hwkui\View\Components\Widget\Accordion\Item;
use Hawkiq\Hwkui\View\Components\Widget\Carousel\Wrapper;

it('normalizes accordion props and exposes the expected public properties', function () {
    $group = new Group('fade', 'true', 'success');
    $item = new Item('Section A', 'chevron-right', '1');

    expect($group->animation)->toBe('fade')
        ->and($group->collapse)->toBeTrue()
        ->and($group->color)->toBe('success')
        ->and($item->heading)->toBe('Section A')
        ->and($item->icon)->toBe('chevron-right')
        ->and($item->disabled)->toBeTrue();
});

it('initializes wrapper with correct default values', function () {
    $wrapper = new Wrapper(items: 3);

    expect($wrapper->items)->toBe(3)
        ->and($wrapper->interval)->toBe(5000)
        ->and($wrapper->breakpoints)->toBe(['default' => 1])
        ->and($wrapper->showControls)->toBeTrue()
        ->and($wrapper->showIndicators)->toBeTrue()
        ->and($wrapper->showCount)->toBeTrue();
});

it('accepts custom values and filters booleans correctly', function () {
    $wrapper = new Wrapper(
        items: 5,
        interval: 2000,
        breakpoints: ['lg' => 3],
        showControls: false,
        showIndicators: false,
        showCount: false
    );

    expect($wrapper->items)->toBe(5)
        ->and($wrapper->interval)->toBe(2000)
        ->and($wrapper->breakpoints)->toBe(['lg' => 3])
        ->and($wrapper->showControls)->toBeFalse()
        ->and($wrapper->showIndicators)->toBeFalse()
        ->and($wrapper->showCount)->toBeFalse();
});
