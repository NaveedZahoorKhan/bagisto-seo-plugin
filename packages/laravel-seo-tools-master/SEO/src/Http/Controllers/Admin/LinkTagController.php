<?php

namespace Rastventure\SEO\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Rastventure\SEO\Repositories\LinkTagRepository;
use SEO\Http\Requests\LinkTags\Create;
use SEO\Http\Requests\LinkTags\Destroy;
use SEO\Http\Requests\LinkTags\Edit;
use SEO\Http\Requests\LinkTags\Index;
use SEO\Http\Requests\LinkTags\Show;
use SEO\Http\Requests\LinkTags\Store;
use SEO\Http\Requests\LinkTags\Update;
use Rastventure\SEO\Models\LinkTag;

/**
 * Description of LinkTagController
 *
 * @author Tuhin Bepari <digitaldreams40@gmail.com>
 */
class LinkTagController extends Controller
{
    protected $linkTagRepository;
    public function __construct(LinkTagRepository $linkTagRepository)
    {
        $this->linkTagRepository = $linkTagRepository;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @param  Index $request
     * @return \Illuminate\Http\Response
     */
    public function index(Index $request)
    {
        return view('linktag.index', ['records' => LinkTag::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Create $request
     * @return \Illuminate\Http\Response
     */
    public function create(Create $request)
    {
        return view('linktag.create', [
            'model' => new LinkTag,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        if ($this->linkTagRepository->create($request->all())) {

            session()->flash('app_message', 'LinkTag saved successfully');
            return redirect()->route('seo_link_tags.index');
        } else {
            session()->flash('app_message', 'Something is wrong while saving LinkTag');
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Edit $request
     * @param  LinkTag $linktag
     * @return \Illuminate\Http\Response
     */
    public function edit(Edit $request, LinkTag $linktag)
    {

        return view('linktag.edit', [
            'model' => $linktag,
        ]);
    }

    /**
     * Update a existing resource in storage.
     *
     * @param  Update $request
     * @param  LinkTag $linktag
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, LinkTag $linktag)
    {
        

        if ($this->linkTagRepository->update($request->all(), $linktag->id)) {

            session()->flash('app_message', 'LinkTag successfully updated');
            return redirect()->route('seo_link_tags.index');
        } else {
            session()->flash('app_error', 'Something is wrong while updating LinkTag');
        }
        return redirect()->back();
    }

    /**
     * Delete a  resource from  storage.
     *
     * @param  Destroy $request
     * @param  LinkTag $linktag
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Destroy $request, LinkTag $linktag)
    {
        if ($linktag->delete()) {
            session()->flash('app_message', 'LinkTag successfully deleted');
        } else {
            session()->flash('app_error', 'Error occurred while deleting LinkTag');
        }

        return redirect()->back();
    }
}
