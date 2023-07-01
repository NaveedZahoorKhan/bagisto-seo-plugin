<?php

namespace Rastventure\SEO\Providers;

use Webkul\Core\Providers\CoreModuleServiceProvider;

class ModuleServiceProvider extends CoreModuleServiceProvider
{
    protected $models = [
        \Rastventure\SEO\Models\LinkTag::class,
        \Rastventure\SEO\Models\MetaTag::class,
        \Rastventure\SEO\Models\Page::class,
        \Rastventure\SEO\Models\PageImage::class,
        \Rastventure\SEO\Models\PageMetaTag::class,
        \Rastventure\SEO\Models\Setting::class,
    ];
}