<?php

namespace Hawkiq\Hwkui;

use Illuminate\Support\Facades\Blade;
use Hawkiq\Hwkui\View\Components\Form;
use Illuminate\Support\ServiceProvider;
use Hawkiq\Hwkui\View\Components\Widget;
use Hawkiq\Hwkui\View\Components\Widget\Timeline;
use Hawkiq\Hwkui\View\Components\Widget\Tabs;
use Hawkiq\Hwkui\View\Components\Widget\Accordion;

class HwkuiServiceProvider extends ServiceProvider
{
    protected $packageName = 'hwkui';

    protected $formComponents = [
        'select' => Form\Select::class,
        'datetime' => Form\Datetime::class,
        'editor' => Form\Editor::class,
        'tom-select' => Form\TomSelect::class,
        'flat-picker' => Form\FlatPicker::class,
        'upload'      => Form\Upload::class,
    ];

    protected $widgetComponents = [
        'card' => Widget\Card::class,
        'info-box' => Widget\InfoBox::class,
        'small-box' => Widget\SmallBox::class,
        'glass-box' => Widget\GlassBox::class,
        'icon' => Widget\Icon::class,
        'alert' => Widget\Alert::class,
        'badge' => Widget\Badge::class,
        'marquee' => Widget\Marquee::class,
        'typewriter' => Widget\Typewriter::class,
    ];

    protected $timelineComponents = [
        'timeline' => Timeline\Timeline::class,
        'item' => Timeline\Item::class,
        'indicator' => Timeline\Indicator::class,
        'content' => Timeline\Content::class,
        'title' => Timeline\Title::class,
        'body' => Timeline\Body::class,
    ];

    protected $tabsComponents = [
        'tabs' => Tabs\Tabs::class,
        'head' => Tabs\Head::class,
        'content' => Tabs\Content::class,
        'head-wrapper' => Tabs\HeadWrapper::class,
        'content-wrapper' => Tabs\ContentWrapper::class,
    ];

    protected $accordionComponents = [
        'group'   => Accordion\Group::class,
        'item'    => Accordion\Item::class,
        'heading' => Accordion\Heading::class,
        'content' => Accordion\Content::class,
    ];

    protected $carouselComponents = [
        'wrapper' => Carousel\Wrapper::class,
        'item' => Carousel\Item::class,
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

        $this->generateComponents();
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

    protected function generateComponents(): void
    {
        $this->registerComponents('timeline', $this->timelineComponents);
        $this->registerComponents('tabs', $this->tabsComponents);
        $this->registerComponents('accordion', $this->accordionComponents);
        $this->registerComponents('carousel', $this->carouselComponents);
    }

    protected function registerComponents(string $prefix, array $components): void
    {
        foreach ($components as $name => $class) {
            Blade::component(
                "{$this->packageName}-{$prefix}.{$name}",
                $class
            );
        }
    }
}
