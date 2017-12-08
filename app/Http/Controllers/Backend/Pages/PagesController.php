<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Pages\CreatePageRequest;
use App\Http\Requests\Backend\Pages\DeletePageRequest;
use App\Http\Requests\Backend\Pages\EditPageRequest;
use App\Http\Requests\Backend\Pages\ManagePageRequest;
use App\Http\Requests\Backend\Pages\StorePageRequest;
use App\Http\Requests\Backend\Pages\UpdatePageRequest;
use App\Models\Page\Page;
use App\Repositories\Backend\Pages\PagesRepository;

/**
 * Class PagesController.
 */
class PagesController extends Controller
{
    protected $pages;

    /**
     * @param \App\Repositories\Backend\Pages\PagesRepository $pages
     */
    public function __construct(PagesRepository $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @param \App\Http\Requests\Backend\Pages\ManagePageRequest $request
     *
     * @return mixed
     */
    public function index(ManagePageRequest $request)
    {
        return view('backend.pages.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Pages\CreatePageRequest $request
     *
     * @return mixed
     */
    public function create(CreatePageRequest $request)
    {
        return view('backend.pages.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Pages\StorePageRequest $request
     *
     * @return mixed
     */
    public function store(StorePageRequest $request)
    {
        $this->pages->create($request->except(['_token']));

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.created'));
    }

    /**
     * @param \App\Models\Page\Page                            $page
     * @param \App\Http\Requests\Backend\Pages\EditPageRequest $request
     *
     * @return mixed
     */
    public function edit(Page $page, EditPageRequest $request)
    {
        return view('backend.pages.edit')
            ->withPage($page);
    }

    /**
     * @param \App\Models\Page\Page                              $page
     * @param \App\Http\Requests\Backend\Pages\UpdatePageRequest $request
     *
     * @return mixed
     */
    public function update(Page $page, UpdatePageRequest $request)
    {
        $this->pages->update($page, $request->except(['_method', '_token']));

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.updated'));
    }

    /**
     * @param \App\Models\Page\Page                              $page
     * @param \App\Http\Requests\Backend\Pages\DeletePageRequest $request
     *
     * @return mixed
     */
    public function destroy(Page $page, DeletePageRequest $request)
    {
        $this->pages->delete($page);

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.deleted'));
    }
}
