<?php

namespace Rastventure\SEO\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Rastventure\SEO\Models\MetaTag;
use Rastventure\SEO\Models\Setting;
use Rastventure\SEO\Services\HtaccessFile;
use Rastventure\SEO\Services\RobotTxt;
use Rastventure\SEO\Services\SiteMap;
use Rastventure\SEO\Http\Requests\Pages\Store;
use Rastventure\SEO\Http\Requests\Pages\Edit;
use Rastventure\SEO\Http\Requests\Pages\Update;
use Rastventure\SEO\Models\Page;
use Rastventure\SEO\Repositories\SettingRepository;
use Webkul\Core\Repositories\CoreConfigRepository;
use Webkul\Core\Tree;

/**
 * Description of SettingController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class SettingController  extends \Webkul\Admin\Http\Controllers\Controller
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
     * Setting repository instance.
     * @var SettingRepository
     */
    protected $settingRepository;

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
    public function __construct(CoreConfigRepository $coreConfigRepository, SettingRepository $settingRepository)
    {
        $this->middleware('admin');

        $this->coreConfigRepository = $coreConfigRepository;
        $this->settingRepository = $settingRepository;
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
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $metaTags = MetaTag::withGroupBy('', 'global');
        $data = [
            'records' => Setting::paginate(10),
            'model' => new Setting(),
            'setting_total' => Setting::count(),
            'page_total' => Page::count(),
            'sitemaps' => (new SiteMap())->all(),
            'metaTags' => isset($metaTags['webmaster_tools']) ? $metaTags['webmaster_tools'] : []
        ];
        return view('seo::admin.pages.settings.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Edit $request
     * @param  Setting $setting
     * @return Response
     */
    public function edit(Edit $request, Setting $setting)
    {
        return view('seo::pages.settings.edit', [
            'model' => $setting,
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Update $request
     * @param  Setting $setting
     * @return Response
     */
    public function update(Update $request, Setting $setting)
    {
        $setting->fill($request->all());

        if ($setting->save()) {
            session()->flash(config('seo.flash_message'), 'Setting successfully updated');
            return redirect()->route('seo::settings.index');
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while updating Setting');
        }
        return redirect()->back();
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Store $request
     * @param  Setting $setting
     * @return Response
     */
    public function store(Store $request)
    {
        $settings = $request->get('settings', []);
        foreach ($settings as $key => $fields) {
            $setting = Setting::where('key', $key)->first();
            if(empty($setting))
                $setting = new Setting();
            // Update the fields
            $setting->key = $key;
            $setting->value = $fields['value'];

            // Save the changes to the database
            $setting->save();
        }
        $fields = $request->file('settings', []);
        $files = Setting::upload($fields);
        foreach ($files as $key => $fileFields) {
            $setting = Setting::where('key', $key)->first();
            if(empty($setting))
                $setting = new Setting();
            // Update the fields
            $setting->key = $key;
            $setting->value = $fileFields['value'];

            // Save the changes to the database
            $setting->save();
        }
        session()->flash(config('seo.flash_message'), 'Setting successfully updated');
        return redirect()->back();
    }

    /**
     * Update robot.txt file
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function robotTxt(Request $request)
    {
        $robotValue = $request->get('robot_txt');
        $robotTxt = new RobotTxt();
        $robotTxt->save($robotValue);
        return redirect()->back()->with(config('seo.flash_message'), 'Robot.txt file updated successfully');
    }

    /**
     * Update robot.txt file
     *
     * @param Request $request
     * @return void
     */
    public function htaccess(Request $request)
    {
        $htaccessValue = $request->get('htaccess');

        $htaccess = new HtaccessFile();
        $htaccess->save($htaccessValue);
        return redirect()->back()->with(config('seo.flash_message'), '.htaccess file updated successfully');
    }
}
