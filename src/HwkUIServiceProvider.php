<?php

namespace Hawkiq\Hwkui;

use Illuminate\Support\ServiceProvider;
use Hawkiq\Hwkui\View\Components\Form;

class HwkuiServiceProvider extends ServiceProvider
{
    protected $packageName = 'hwkui';

    protected $formComponents = [
        'select' => Form\Select::class,
        'datetime' => Form\DateTime::class,
        'editor' => Form\Editor::class,
    ];

    public function boot()
    {
        $this->registerPublishing();
        $this->registerViews();
        $this->loadComponents();
    }

/**
 * The function `registerPublishing` in PHP registers the publishing of views and configuration files
 * for a package.
 */
    protected function registerPublishing()
    {

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/hwkui'),
            __DIR__ . '/../resources/views/components' => resource_path('views/vendor/hwkui/components'),
        ], 'hwkui-views');

        $this->publishes([
            __DIR__ . '/../config/hwkui.php' => config_path('hwkui.php'),
        ], 'hwkui-config');
    }

    /**
     * Register views.
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', $this->packageName);
    }

    /**
     * Merge package configuration with application configuration.
     */
    protected function mergeConfiguration()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/hwkui.php',
            $this->packageName
        );
    }

    /**
     * The function `loadComponents` merges form components and loads them as view components for a
     * specific package.
     */
    private function loadComponents()
    {

        $components = array_merge(
            $this->formComponents
        );

        $this->loadViewComponentsAs($this->packageName, $components);
    }


    public function register()
    {
        $this->mergeConfiguration();
    }
}
