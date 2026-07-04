<?php

use Hawkiq\Hwkui\View\Components\Widget\Badge;

it('renders the badge component with shape, color, and icon helpers', function () {
    $component = new Badge('pill', 'success', 'lg', 'check');

    expect($component->getShapeClasses())->toContain('rounded-full')
        ->and($component->getIconSizeClass())->toBe('w-5 h-5')
        ->and($component->getColorClasses())->toContain('bg-emerald-600');
});
