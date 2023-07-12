<?php

namespace Rastventure\SEO\Providers;

use Rastventure\SEO\Policies\MetaTagPolicy;
use Rastventure\SEO\Policies\SettingPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Rastventure\SEO\Models\MetaTag;
use Rastventure\SEO\Models\Page;
use Rastventure\SEO\Models\PageImage;
use Rastventure\SEO\Models\Setting;

use Illuminate\Support\Facades\Route;
use Rastventure\SEO\Policies\ImagePolicy;
use Rastventure\SEO\Policies\PagePolicy;
use Webkul\CMS\Models\CmsPage;

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
        // $this->publishes([
        //     __DIR__ . '/../Config/seo.php' => config_path('seo.php'),
        //     __DIR__ . '/../Resources/views' => resource_path('views/vendor/seo'),
        // ]); 
        //  $this->publishes([
        //     __DIR__ . '/../Policies' => base_path('app/Policies/Seo')
        // ], 'seo-policies');

        if (stristr($this->app->request->getRequestUri(), "admin/seo")) {
            Event::listen('bagisto.admin.layout.head', function ($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate('seo::admin.layouts.style');
            });

            Event::listen('bagisto.shop.layout.body.after', function ($viewRenderEventManager) {
                $viewRenderEventManager->addTemplate('seo::admin.layouts.scripts');
            });
        }
        Event::listen('cms.pages.update.after', function ($id) {
            $cmsPage = CmsPage::find($id);

            if (empty($cmsPage))
                return;
            $data = $cmsPage->translate('en');
            Page::updateOrCreate(
                ['cms_page_id' => $cmsPage->id],
                [
                    'cms_page_id' => $cmsPage->id,
                    'title' => $data['page_title'], 'path' => $data['url_key'],
                    'robot_index' => $data['robot_index'], 'robot_follow' => $data['robot_follow'],
                    'canonical_url' => $data['canonical_url'], 'description' => $data['meta_description']
                ]
            );
        });
        Event::listen('cms.pages.create.after', function($cmsPage){
            $data = $cmsPage->translate('en');

            Page::updateOrCreate(
                ['cms_page_id' => $cmsPage->id],
                [
                    'cms_page_id' => $cmsPage->id,
                    'title' => $data['page_title'], 'path' => $data['url_key'],
                    'robot_index' => $data['robot_index'], 'robot_follow' => $data['robot_follow'],
                    'canonical_url' => $data['canonical_url'], 'description' => $data['meta_description']
                ]
            );
        });
        $blade = app('view')->getEngineResolver()->resolve('blade')->getCompiler();
        $blade->directive('seoForm', function ($model) {
            return "<?php echo \Rastventure\SEO\Seo::form($model); ?>";
        });

        $blade->directive('seoTags', function ($model) {
            return "{{ print((new \Rastventure\SEO\Seo())->tags()); }}";
        });
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
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        Gate::policy(Page::class, PagePolicy::class);
        Gate::policy(Setting::class, SettingPolicy::class);
        Gate::policy(MetaTag::class, MetaTagPolicy::class);
        Gate::policy(PageImage::class, ImagePolicy::class);
    }

    public function register()
    {
        $this->registerPolicies();
        $this->registerConfig();
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/seo.php',
            'seo'
        );

        Event::listen(['eloquent.saved: *', 'eloquent.created: *'], function ($name, $models) {
            $modelConfig = config('rastventure.seo.models');
            if (empty($modelConfig)) {
                return;
            }
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
        $this->app->bind(Seeder::class, function () {
            return new \Rastventure\SEO\Database\Seeders\SeoTablesSeeder();
        });
        $this->commands([
            \Rastventure\SEO\Console\Commands\Install::class,
            \Rastventure\SEO\Console\Commands\Uninstall::class,
        ]);
    }
    /**
     * To register seo as first level command. E.g. seo:model
     *
     * @return array
     */
    public function provides()
    {
        return [
            'seo',
            Seeder::class, // Add Seeder class binding to service container
        ];
    }
}
