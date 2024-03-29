<?php

namespace Rastventure\SEO\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataConverter\FileCsv;
use DataConverter\FileManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Rastventure\SEO\Contracts\LinkProvider;
use Rastventure\SEO\Http\Requests\Pages\BulkUpdate;
use Rastventure\SEO\Http\Requests\Pages\Create;
use Rastventure\SEO\Http\Requests\Pages\Destroy;
use Rastventure\SEO\Http\Requests\Pages\Download;
use Rastventure\SEO\Http\Requests\Pages\Edit;
use Rastventure\SEO\Http\Requests\Pages\Index;
use Rastventure\SEO\Http\Requests\Pages\Show;
use Rastventure\SEO\Http\Requests\Pages\Store;
use Rastventure\SEO\Http\Requests\Pages\Update;
use Rastventure\SEO\Http\Requests\Pages\Upload;
use Rastventure\SEO\Jobs\PageCacheJob;
use Rastventure\SEO\Jobs\PageGeneratorJob;
use Rastventure\SEO\Jobs\PageUploadJob;
use Rastventure\SEO\Models\Page;
use Rastventure\SEO\Models\PageImage;
use Rastventure\SEO\Models\PageMetaTag;
use Rastventure\SEO\Services\PageAnalysis;
use Rastventure\SEO\Tag;
use Rastventure\SEO\Seo;
use Rastventure\SEO\Services\KeywordAnalysis;
use Illuminate\Support\Facades\DB;
use Rastventure\SEO\Repositories\PageRepository;
use Webkul\CMS\Models\CmsPageTranslation;

/**
 * Description of PageController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class PageController extends Controller
{

    protected PageRepository $pageRepository;

    /**
     * 
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Index $request
     * @return Response
     */
    public function index(Index $request)
    {
        $q = $request->get('search');
        $object = $request->get('object');
        $builder = Page::withCount(['pageImages']);
        if (!empty($q)) {
            $builder = $builder->search($q);
        }
        if (!empty($object)) {
            $builder = $builder->where('object', $object);
        }
        return view('seo::admin.pages.pages.index', [
            'objects' => DB::table('seo_pages')->distinct()->get(['object'])->pluck('object')->toArray(),
            'records' => $builder->latest()->paginate(6)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Show $request
     * @param Page $page
     * @return Response
     * @throws \Exception
     */
    public function show(Show $request, Page $page)
    {
        $data = [
            'record' => $page,
            'success' => false
        ];
        $pageAnalysis = new KeywordAnalysis($page->getFullUrl(), $page->keyword);

        if ($pageAnalysis->isSuccess()) {
            $data = array_merge($pageAnalysis->save()->toArray(), $data);
            $data['result'] = $pageAnalysis->run()->result();
            $data['success'] = true;
        }
        return view('seo::admin.pages.pages.show', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Create $request
     * @return Response
     */
    public function create(Create $request)
    {
        $page = new Page();
        $metaTags = $page->pageLevel();
        $og = null;
        $twitter = null;
        if (isset($metaTags['og'])) {
            $og = $metaTags['og'];
            unset($metaTags['og']);
        }

        if (isset($metaTags['twitter'])) {
            $twitter = $metaTags['twitter'];
            unset($metaTags['twitter']);
        }
        return view('seo::admin.pages.pages.create', [
            'record' => $page,
            'og' => $og,
            'twitter' => $twitter,
            'metaTags' => $metaTags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Store $request
     * @return Response
     */
    public function store(Store $request)
    {
        $model = new Page;
        $model->fill($request->get('page'));

        if ($model->save()) {
            $model->saveMeta(request()->get('meta', []));
            $model->saveMeta(Seo::upload(request()->file('meta', []), $model));
            $tag = new Tag($model);
            $tag->make()->save();
            session()->flash(config('seo.flash_message'), 'Page saved successfully');
            return redirect()->route('pages.index');
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while saving Page');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Edit $request
     * @param Page $page
     * @return Response
     */
    public function edit(Edit $request, Page $page)
    {
        $keywordAnalysis = false;
        $metaTags = $page->metaTags();

        if (isset($metaTags['og'])) {
            $og = $metaTags['og'];
            unset($metaTags['og']);
        }
        if (!empty($page->focus_keyword)) {
            $keyword = new KeywordAnalysis($page->path, $page->focus_keyword);
            $keywordAnalysis = $keyword->run()->result();
        }
        if (isset($metaTags['twitter'])) {
            $twitter = $metaTags['twitter'];
            unset($metaTags['twitter']);
        }
        return view('seo::admin.pages.pages.edit', [
            'record' => $page,
            'og' => $og,
            'twitter' => $twitter,
            'metaTags' => $metaTags,
            'keywordAnalysis' => $keywordAnalysis
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bulkEdit()
    {
        return view('seo::pages.pages.bulk-edit', ['pages' => Page::paginate(5)]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param Update $request
     * @param Page $page
     * @return Response
     */
    public function update(Update $request, Page $page)
    {
        $page->fill($request->get('page'));
        $cmsPage = CmsPageTranslation::where([
            'cms_page_id' => $page->cms_page_id,
            'locale' => 'en'
        ])->first();
        if (empty($cmsPage)) {
            session()->flash(config('seo.flash_error'), 'Something is wrong while updating Page');
            return redirect()->back();
        }
        if ($page->save()) {
            $cmsPage->page_title = $page->title;
            $cmsPage->url_key = $page->path;
            $cmsPage->canonical_url = $page->canonical_url;
            $cmsPage->robot_index = $page->robot_index;
            $cmsPage->robot_follow = $page->robot_follow;
            $cmsPage->meta_description = $page->description;
            $cmsPage->meta_title = $page->title;

            $cmsPage->update();
            $page->saveMeta(request()->get('meta', []));
            $page->saveMeta(Seo::upload(request()->file('meta', []), $page));
            $tag = new Tag($page);
            $tag->make()->save();
            session()->flash(config('seo.flash_message'), 'Page successfully updated');
            return redirect()->route('pages.index');
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while updating Page');
        }
        return redirect()->back();
    }

    /**
     * @param BulkUpdate $update
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bulkUpdate(BulkUpdate $update)
    {
        $mit = new \MultipleIterator(\MultipleIterator::MIT_KEYS_ASSOC);
        $mit->attachIterator(new \ArrayIterator($update->get('page_id')), "id");
        $mit->attachIterator(new \ArrayIterator($update->get('title')), "title");
        $mit->attachIterator(new \ArrayIterator($update->get('description')), "description");
        $mit->attachIterator(new \ArrayIterator($update->get('robot_index')), "robot_index");

        foreach ($mit as $page) {
            $pageModel = Page::find($page['id']);

            if ($pageModel) {
                $pageModel->title = $page['title'];
                $pageModel->description = $page['description'];
                $pageModel->robot_index = !empty($page['robot_index']) ? $page['robot_index'] : 'noindex';
                $pageModel->save();
                $tag = new Tag($pageModel);
                $tag->make()->save();
            }
        }
        return redirect()->back()->with(config('seo.flash_message'), 'Pages saved successfully');
    }

    /**
     * Delete a  resource from  storage.
     *
     * @param Request $request
     * @param Page $page
     * @return Response
     * @throws \Exception
     */
    public function destroy(Destroy $request, Page $page)
    {
        if ($page->delete()) {
            session()->flash(config('seo.flash_message'), 'Page successfully deleted');
        } else {
            session()->flash(config('seo.flash_error'), 'Error occurred while deleting Page');
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generate(Request $request)
    {
        dispatch(new PageGeneratorJob());
        return redirect()->route('seo::pages.index')->with(config('seo.flash_message'), ' Your request are in queue now. ');
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function meta(Request $request, Page $page)
    {
        $og = [];
        $twitter = [];
        $metaTags = $page->metaTags();

        if (isset($metaTags['og'])) {
            $og = $metaTags['og'];
            unset($metaTags['og']);
        }

        if (isset($metaTags['twitter'])) {
            $twitter = $metaTags['twitter'];
            unset($metaTags['twitter']);
        }

        return view('seo::pages.pages.meta_tags', [
            'record' => $page,
            'og' => $og,
            'twitter' => $twitter,
            'metaTags' => $metaTags,
        ]);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveMeta(Request $request, Page $page)
    {
        $metaValues = $request->get('meta', []);
        $page->saveMeta($metaValues);
        return redirect()->back()->with(config('seo.flash_message'), 'Page meta tags saved successfully');
    }

    /**
     * Upload pages from csv,excel
     * @param Upload $upload
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Upload $upload)
    {
        $totalPage = 0;
        if ($upload->hasFile('file') && $upload->file('file')->isValid()) {
            $filePath = $upload->file('file')->store('pages', 'public');
            $fullPath = storage_path("app/public/" . $filePath);

            if (file_exists($fullPath)) {
                dispatch(new PageUploadJob($fullPath));
                return redirect()->back()->with(config('seo.flash_message'), 'Your file are in queue now.');
            }
        } else {
            return redirect()->back()->with(config('seo.flash_error'), 'Invalid file');
        }
    }

    /**
     * Download page as csv
     *
     * @param Download $download
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Download $download)
    {
        $headline = ['id', 'path', 'canonical_url', 'title', 'description', 'robot_index', 'robot_follow', 'change_frequency', 'priority'];
        $pages = Page::all($headline);
        $fileManager = new FileCsv();
        $filePath = storage_path('app/public/pages/' . uniqid(date('Ymd_')) . '.csv');
        if (!file_exists(storage_path('app/public/pages'))) {
            mkdir(storage_path('app/public/pages'), 0777, true);
        }
        $data = [];
        foreach ($pages as $page) {
            $data[] = [
                'id' => '"' . $page->id . '"',
                'path' => '"' . $page->path . '"',
                'canonical_url' => '"' . $page->getCanonical() . '"',
                'title' => '"' . $page->getTitle() . '"',
                'description' => '"' . $page->getDescription() . '"',
                'robot_index' => '"' . $page->robot_index . '"',
                'robot_follow' => '"' . $page->robot_follow . '"',
                'change_frequency' => '"' . $page->getChangeFrequency() . '"',
                'priority' => '"' . $page->getPriority() . '"',
            ];
        }
        array_unshift($data, $headline);
        $manager = $fileManager->config([
            'file_path' => $filePath,
            'data' => $data
        ]);
        $manager->write();
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->back()->with(config('seo.flash_error'), 'Unable to download');
    }

    /**
     * @param Image $image
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function images(Image $image, Page $page)
    {
        $data = [
            'record' => $page
        ];
        return view('seo::pages.pages.images', $data);
    }

    /**
     * Cache page seo tags
     */
    public function cache()
    {
        dispatch(new PageCacheJob());
        return redirect()->back()->with(config('seo.flash_message'), 'Your request to refresh cache are in queue now.');
    }

    /**
     * Download folder as zip
     */
    public function zip()
    {
        if (!file_exists(storage_path('download'))) {
            mkdir(storage_path('download'));
        }
        $zipname = storage_path('download/pages.zip');

        if (file_exists($zipname)) {
            unlink($zipname);
        }

        $pages = Page::all();
        $cachePath = config('seo.cache.storage');
        if (!file_exists($cachePath)) {
            mkdir($cachePath, 0777, true);
        }
        foreach ($pages as $page) {
            if (!file_exists($cachePath . "/" . $page->id . 'html')) {
                $tag = new Tag($page);
                $tag->make()->save();
            }
        }

        $zip = new \ZipArchive;
        $zip->open($zipname, \ZipArchive::CREATE);

        $dir = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($cachePath), \RecursiveIteratorIterator::SELF_FIRST);
        foreach ($dir as $name => $it) {
            if (in_array($it->getBasename(), [".", ".."])) {
                continue;
            }
            $pageModel = $pages->find($it->getBasename(".html"));
            $filePath = is_object($pageModel) ? $pageModel->path . '.html' : $it->getBasename();
            $zip->addFile($it->getPathname(), $filePath);
        }

        $zip->close();
        if (file_exists($zipname)) {
            return response()->download($zipname);
        }
        return response()->download($zipname);
    }

    public function updateSavedTags(Edit $request, Page $page)
    {
        $tag = new Tag($page);
        $tag->make()->save();
        return redirect()->back()->with('app_message', 'Page tags successfully updated');
    }
}
