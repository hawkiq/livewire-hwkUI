<?php

namespace Hawkiq\Hwkui\Tests;

use Hawkiq\Hwkui\HwkuiServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [HwkuiServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('view.paths', [resource_path('views'), __DIR__.'/../resources/views']);
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
    }
}
