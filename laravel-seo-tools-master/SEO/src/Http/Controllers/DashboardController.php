<?php

/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 12/22/2017
 * Time: 8:52 PM
 */

namespace Rastventure\SEO\Http\Controllers;


use Illuminate\Http\Request;
use Rastventure\SEO\Models\MetaTag;
use Rastventure\SEO\Models\Page;
use Rastventure\SEO\Models\Setting;
use Rastventure\SEO\Services\SiteMap;
use Webkul\Core\Repositories\CoreConfigRepository;
use Webkul\Core\Tree;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

class DashboardController extends \Webkul\Admin\Http\Controllers\Controller
{

    /**
     * Display a listing of the resource.
     *
     * @var \Illuminate\Http\Response
     */
    protected $_config;

    /**
     * Core config repository instance.
     *
     * @var \Webkul\Core\Repositories\CoreConfigRepository
     */
    protected $coreConfigRepository;

    /**
     * Tree instance.
     *
     * @var \Webkul\Core\Tree
     */
    protected $configTree;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Core\Repositories\CoreConfigRepository  $coreConfigRepository
     * @return void
     */
    public function __construct(CoreConfigRepository $coreConfigRepository, Request $request)
    {
        $this->middleware('admin');
        $this->coreConfigRepository = $coreConfigRepository;
        $this->_config =  config();

        $this->prepareConfigTree();
    }

    /**
     * Prepares config tree.
     *
     * @return void
     */
    public function prepareConfigTree()
    {
        $tree = Tree::create();

        foreach (config('core') as $item) {
            $tree->add($item);
        }

        $tree->items = core()->sortItems($tree->items);

        $this->configTree = $tree;
    }


    public function index(Request $request)
    {
        $metaTags = MetaTag::withGroupBy('', 'global');
        $data = [
            'records' => Setting::paginate(10),
            'model' => new Setting(),
            'page_total' => Page::count(),
            'meta_tag_total' => MetaTag::count(),
            'setting_total' => Setting::count(),
            'webmasterTags' => isset($metaTags['webmaster_tools']) ? $metaTags['webmaster_tools'] : []
        ];
        // dd($this->_config['view']['paths'][0]);
        return view('seo::pages.dashboard.index', ['data' => $data]);
    }

    /**
     * Manage Social Media
     */
    public function social()
    {
        $metaTags = MetaTag::forGlobal();
        $data = [
            'records' => Setting::paginate(10),
            'og' => isset($metaTags['og']) ? $metaTags['og'] : [],
            'twitter' => isset($metaTags['twitter']) ? $metaTags['twitter'] : [],
            'model' => new Setting(),
        ];
        return view('seo::pages.dashboard.social', $data);
    }

    /**
     * Manage Site map
     */
    public function sitemap()
    {
        $data = [
            'pages' => Page::where('robot_index', 'index')->paginate(15),
            'sitemaps' => (new SiteMap())->all()
        ];
        return view('seo::pages.dashboard.sitemap', $data);
    }

    /**
     *  Import Export and Download Pages
     */
    public function tools()
    {
        $data = [];
        return view('seo::pages.dashboard.tools', $data);
    }

    /**
     *
     */
    public function advanced()
    {
        $data = [];
        return view('seo::pages.dashboard.advanced', $data);
    }
}
