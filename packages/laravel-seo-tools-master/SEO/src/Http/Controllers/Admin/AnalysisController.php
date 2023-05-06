<?php

/**
 * Created by PhpStorm.
 * User: Tuhin
 * Date: 2/28/2018
 * Time: 12:07 PM
 */

namespace Rastventure\SEO\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Rastventure\SEO\Services\KeywordAnalysis;
use Webkul\Core\Tree;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Webkul\Admin\Http\Requests\ConfigurationForm;
use Webkul\Core\Repositories\CoreConfigRepository;

class AnalysisController extends \Webkul\Admin\Http\Controllers\Controller
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
    public function __construct(CoreConfigRepository $coreConfigRepository)
    {
        $this->middleware('admin');

        $this->coreConfigRepository = $coreConfigRepository;

        $this->_config = request('_config');

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
        $url = $request->get('url');
        $keyword = $request->get('keyword');

        $data = [
            'success' => false
        ];
        if (!empty($url)) {
            $pageAnalysis = new KeywordAnalysis($url, $keyword, true);
            if ($pageAnalysis->isSuccess()) {
                $data = array_merge($pageAnalysis->toArray(), $data);
                $data['success'] = true;
                $data['result'] = $pageAnalysis->run()->result();
            }
        }

        return view($this->_config['view'], compact('data'));
    }
}
