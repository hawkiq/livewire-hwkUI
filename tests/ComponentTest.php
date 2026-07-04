<?php

use Hawkiq\Hwkui\Helpers\PluginLoader;
use Hawkiq\Hwkui\HwkuiServiceProvider;
use Hawkiq\Hwkui\View\Components\Form\Select;
use Hawkiq\Hwkui\View\Components\Form\Upload;
use Illuminate\Support\Facades\Blade;

it('registers the main package service provider and config', function () {
    expect(config('hwkui'))->toBeArray();
    expect(config('hwkui.plugins'))->toBeArray();
    expect(app()->getProvider(HwkuiServiceProvider::class))->toBeInstanceOf(HwkuiServiceProvider::class);
});

it('renders the select component with label and slot content', function () {
    $html = Blade::render('<x-hwkui-select label="Choose" id="country"><option value="us">US</option></x-hwkui-select>');

    expect($html)->toContain('Choose')
        ->and($html)->toContain('select2')
        ->and($html)->toContain('id="country"');
});

it('hydrates select options from arrays and json', function () {
    $arrayComponent = new Select(['foo' => 'bar']);
    $jsonComponent = new Select('{"foo":"bar"}');

    expect($arrayComponent->options)->toBe(['foo' => 'bar'])
        ->and($jsonComponent->options)->toBe(['foo' => 'bar']);
});

it('stores upload props and preserves the multiple flag', function () {
    $component = new Upload(hint: 'Drop files', preview: true, multiple: true, max: 3);

    expect($component->hint)->toBe('Drop files')
        ->and($component->preview)->toBeTrue()
        ->and($component->multiple)->toBeTrue()
        ->and($component->max)->toBe(3);
});

it('tracks required plugins from component rendering', function () {
    PluginLoader::require('Select2');

    expect(PluginLoader::getRequired())->toContain('Select2');
});

it('registers the blade directive for hwkui styles', function () {
    $output = Blade::render('@hwkuiStyles');

    expect($output)->toContain('vendor/hwkui/dist/hwkui.min.css');
});
