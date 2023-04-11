<?php

namespace Rastventure\SEO\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Rastventure\SEO\Models\MetaTag;
use Rastventure\SEO\Models\Page;
use Rastventure\SEO\Models\PageImage;
use Rastventure\SEO\Models\Setting;
use App\Policies\Seo\ImagePolicy;
use App\Policies\Seo\MetaTagPolicy;
use App\Policies\Seo\PagePolicy;
use App\Policies\Seo\SettingPolicy;
use Illuminate\Support\Facades\Route;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * The policies
     *
     * @var array
     */
    protected $policies = [
        //'Model' => 'Policies\ModelPolicy',
        Setting::class => SettingPolicy::class,
        Page::class => PagePolicy::class,
        MetaTag::class => MetaTagPolicy::class,
        PageImage::class => ImagePolicy::class
    ];

    /**
     *
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/admin-routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'seo');
        /*$this->publishes([
            __DIR__ . '/../config/seo.php' => config_path('seo.php'),
            __DIR__ . '/../resources/views' => resource_path('views/vendor/seo'),
        ]);
        $this->publishes([
            __DIR__ . '/Policies' => base_path('app/Policies/Seo')
        ], 'seo-policies');*/

        if (stristr($this->app->request->getRequestUri(), "admin/seo")) {
            Event::listen('bagisto.admin.layout.head', function ($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate('seo::layouts.style');
            });

            Event::listen('bagisto.shop.layout.body.after', function ($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate('seo::layouts.scripts');
            });
        }
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/admin-menu.php',
            'menu.admin'
        );
    }

    /**
     *
     */
    public function register()
    {
        $this->registerPolicies();
        $this->registerConfig();
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/seo.php',
            'seo'
        );
        $blade = app('view')->getEngineResolver()->resolve('blade')->getCompiler();
        $blade->directive('seoForm', function ($model) {
            return "<?php echo \Rastventure\SEO\Seo::form($model); ?>";
        });
        $blade->directive('seoTags', function ($model) {
            return "<?php print((new \Rastventure\SEO\Seo())->tags()); ?>";
        });
        Event::listen(['eloquent.saved: *', 'eloquent.created: *'], function ($name, $models) {
            $modelConfig = config('rastventure.seo.models');
            $modelNames = array_keys($modelConfig);

            foreach ($models as $model) {
                $modelClassName = get_class($model);
                if (in_array($modelClassName, $modelNames)) {
                    if (isset($modelConfig[$modelClassName]['route'])) {
                        $routes = $modelConfig[$modelClassName]['route'];
                        $allowedRoutes = is_array($routes) ? $routes : [$routes];
                        if (!in_array(Route::currentRouteName(), $allowedRoutes)) {
                            continue;
                        }
                    }
                    if (!isset($modelConfig[$modelClassName]['job'])) {
                        continue;
                    }
                    $jobClass = $modelConfig[$modelClassName]['job'];
                    $jobClass::dispatch($model)->onConnection('sync');
                }
            }
        });
    }

    /**
     * Register the Permitlication's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    /**
     * To register seo as first level command. E.g. seo:model
     *
     * @return array
     */
    public function provides()
    {
        return ['seo'];
    }
}
