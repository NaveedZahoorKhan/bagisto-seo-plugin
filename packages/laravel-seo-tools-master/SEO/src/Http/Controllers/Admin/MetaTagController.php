<?php

namespace Rastventure\SEO\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Rastventure\SEO\Http\Requests\MetaTags\Create;
use Rastventure\SEO\Http\Requests\MetaTags\Destroy;
use Rastventure\SEO\Http\Requests\MetaTags\Edit;
use Rastventure\SEO\Http\Requests\MetaTags\Index;
use Rastventure\SEO\Http\Requests\MetaTags\Show;
use Rastventure\SEO\Http\Requests\MetaTags\Store;
use Rastventure\SEO\Http\Requests\MetaTags\Update;
use Rastventure\SEO\Models\MetaTag;
use Rastventure\SEO\Models\PageMetaTag;
use Rastventure\SEO\Repositories\MetaTagRepository;
use Rastventure\SEO\Repositories\PageMetaTagRepository;

/**
 * Description of MetaTagController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class MetaTagController extends Controller
{
    protected $metaTagRepository;
    protected $pageMetaTagRepository;
    /**
     * 
     */
    public function __construct(MetaTagRepository $metaTagRepository, PageMetaTagRepository $pageMetaTagRepository )
    {
        $this->metaTagRepository = $metaTagRepository;
        $this->pageMetaTagRepository = $pageMetaTagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Index $request
     * @return Response
     */
    public function index(Index $request)
    {
        return view('seo::admin.pages.meta_tags.index', ['records' => MetaTag::paginate(6)]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param  Create $request
     * @return Response
     */
    public function create(Create $request)
    {
        return view('seo::admin.pages.meta_tags.create', [
            'model' => new MetaTag,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store $request
     * @return Response
     */
    public function store(Store $request)
    {
        if ($this->metaTagRepository->save($request->all())) {
            session()->flash(config('seo.flash_message'), 'MetaTag saved successfully');
            return redirect()->route('meta-tags.index');
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while saving MetaTag');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Edit $request
     * @param  MetaTag $meta_tag
     * @return Response
     */
    public function edit(Edit $request, MetaTag $meta_tag)
    {
        return view('seo::admin.pages.meta_tags.edit', [
            'model' => $meta_tag,
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Update $request
     * @param  MetaTag $meta_tag
     * @return Response
     */
    public function update(Update $request, MetaTag $meta_tag)
    {
        if ($this->metaTagRepository->update($request->all(), $meta_tag->id)) {
            session()->flash(config('seo.flash_message'), 'MetaTag successfully updated');
            return redirect()->route('seo::meta-tags.index');
        } else {
            session()->flash(config('seo.flash_error'), 'Something is wrong while updating MetaTag');
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function global(Request $request)
    {
        $metaValues = $request->get('meta', []);
        foreach ($metaValues as $id => $content) {
            $pageMeta = $this->pageMetaTagRepository->firstOrCreate(['seo_page_id' => null, 'seo_meta_tag_id' => $id]);
            $pageMeta->content = $content;
            $pageMeta->save();
        }
        return redirect()->back()->with(config('seo.flash_message'), 'Global Meta Tags saved successfully');
    }

    /**
     * Delete a  resource from  storage.
     *
     * @param  Destroy $request
     * @param  MetaTag $meta_tag
     * @return Response
     * @throws \Exception
     */
    public function destroy(Destroy $request, MetaTag $meta_tag)
    {
        if ($meta_tag->delete()) {
            session()->flash(config('seo.flash_message'), 'MetaTag successfully deleted');
        } else {
            session()->flash(config('seo.flash_error'), 'Error occurred while deleting MetaTag');
        }

        return redirect()->back();
    }
}
