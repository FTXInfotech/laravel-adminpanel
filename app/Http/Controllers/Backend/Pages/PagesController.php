<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Pages\CreatePageRequest;
use App\Http\Requests\Backend\Pages\DeletePageRequest;
use App\Http\Requests\Backend\Pages\EditPageRequest;
use App\Http\Requests\Backend\Pages\ManagePageRequest;
use App\Http\Requests\Backend\Pages\StorePageRequest;
use App\Http\Requests\Backend\Pages\UpdatePageRequest;
use App\Http\Responses\Backend\Page\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
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
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManagePageRequest $request)
    {
        return new ViewResponse('backend.pages.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Pages\CreatePageRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreatePageRequest $request)
    {
        return new ViewResponse('backend.pages.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Pages\StorePageRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StorePageRequest $request)
    {
        $this->pages->create($request->except(['_token']));

        return new RedirectResponse(route('admin.pages.index'), ['flash_success' => trans('alerts.backend.pages.created')]);
    }

    /**
     * @param \App\Models\Page\Page                            $page
     * @param \App\Http\Requests\Backend\Pages\EditPageRequest $request
     *
     * @return \App\Http\Responses\Backend\Page\EditResponse
     */
    public function edit(Page $page, EditPageRequest $request)
    {
        return new EditResponse($page);
    }

    /**
     * @param \App\Models\Page\Page                              $page
     * @param \App\Http\Requests\Backend\Pages\UpdatePageRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Page $page, UpdatePageRequest $request)
    {
        $this->pages->update($page, $request->except(['_method', '_token']));

        return new RedirectResponse(route('admin.pages.index'), ['flash_success' => trans('alerts.backend.pages.updated')]);
    }

    /**
     * @param \App\Models\Page\Page                              $page
     * @param \App\Http\Requests\Backend\Pages\DeletePageRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Page $page, DeletePageRequest $request)
    {
        $this->pages->delete($page);

        return new RedirectResponse(route('admin.pages.index'), ['flash_success' => trans('alerts.backend.pages.deleted')]);
    }
}
