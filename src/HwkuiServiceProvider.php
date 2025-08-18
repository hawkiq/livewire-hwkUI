<?php

namespace Hawkiq\Hwkui;

use Illuminate\Support\Facades\Blade;
use Hawkiq\Hwkui\View\Components\Form;
use Illuminate\Support\ServiceProvider;
use Hawkiq\Hwkui\View\Components\Widget;

class HwkuiServiceProvider extends ServiceProvider
{
    protected $packageName = 'hwkui';

    protected $formComponents = [
        'select' => Form\Select::class,
        'datetime' => Form\Datetime::class,
        'editor' => Form\Editor::class,
    ];

    protected $widgetComponents = [
        'card' => Widget\Card::class,
        'info-box' => Widget\InfoBox::class,
        'small-box' => Widget\SmallBox::class,
    ];

    public function boot()
    {
        $this->registerPublishing();
        $this->registerViews();
        $this->loadComponents();
        $this->registerStyles();
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

        $this->publishes([
            __DIR__ . '/../resources/css' => resource_path('css'),
        ], 'hwkui-assets');
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
            $this->formComponents,
            $this->widgetComponents
        );

        $this->loadViewComponentsAs($this->packageName, $components);
    }

    private function registerStyles()
    {
        //@hwkuiStyles
        Blade::directive('hwkuiStyles', function () {
            return '<link rel="stylesheet" href="' . asset('vendor/hwkui/dist/hwkui.min.css') . '">';
        });
    }

    public function register()
    {
        $this->mergeConfiguration();
    }
}
