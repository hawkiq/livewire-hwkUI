<?php

use Hawkiq\Hwkui\View\Components\Widget\Card;

it('renders the card component class helpers for outline and full themes', function () {
    $outline = new Card(title: 'Hello', theme: 'primary', themeMode: 'outline');
    $full = new Card(title: 'Hello', theme: 'danger', themeMode: 'full');

    expect($outline->cardClasses())->toContain('border')
        ->and($full->cardClasses())->toContain('text-white')
        ->and($outline->headerClasses())->toContain('font-semibold')
        ->and($full->headerClasses())->toContain('text-white');
});
