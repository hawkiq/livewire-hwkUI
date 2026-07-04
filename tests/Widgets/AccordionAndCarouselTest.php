<?php

use Hawkiq\Hwkui\View\Components\Widget\Accordion\Group;
use Hawkiq\Hwkui\View\Components\Widget\Accordion\Item;
use Hawkiq\Hwkui\View\Components\Widget\Carousel\Item as CarouselItem;
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

it('stores carousel wrapper and item props', function () {
    $wrapper = new Wrapper([['title' => 'One']], 3000);
    $item = new CarouselItem(2);

    expect($wrapper->items)->toBe([['title' => 'One']])
        ->and($wrapper->interval)->toBe(3000)
        ->and($item->index)->toBe(2);
});
