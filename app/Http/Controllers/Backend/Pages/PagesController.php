<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Pages\DeletePageRequest;
use App\Http\Requests\Backend\Pages\ManagePageRequest;
use App\Http\Requests\Backend\Pages\StorePageRequest;
use App\Http\Requests\Backend\Pages\UpdatePageRequest;
use App\Http\Responses\Backend\Page\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Pages\Page;
use App\Repositories\Backend\Pages\PagesRepository;

class PagesController extends Controller
{
    /**
     * @var PagesRepository
     */
    protected $page;

    /**
     * @param \App\Repositories\Backend\Pages\PagesRepository $page
     */
    public function __construct(PagesRepository $page)
    {
        $this->page = $page;
    }

    /**
     * @param \App\Http\Requests\Backend\Pages\ManagePagesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageBlogsRequest $request)
    {
        return new ViewResponse('backend.pages.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Pages\ManagePageRequest $request
     *
     * @return ViewResponse
     */
    public function create(ManagePageRequest $request)
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
        $this->page->create($request->except('_token'));

        return new RedirectResponse(route('admin.pages.index'), ['flash_success' => trans('alerts.backend.pages.created')]);
    }

    /**
     * @param \App\Models\Pages\Page                                $page
     * @param \App\Http\Requests\Backend\Pages\ManagePageRequest    $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Page $page, ManagePageRequest $request)
    {
        return new EditResponse($page);
    }

    /**
     * @param \App\Models\Pages\Page                                $page
     * @param \App\Http\Requests\Backend\Pages\UpdatePageRequest    $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Page $page, UpdatePageRequest $request)
    {
        $input = $request->all();

        $this->page->update($page, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.pages.index'), ['flash_success' => trans('alerts.backend.pages.updated')]);
    }

    /**
     * @param \App\Models\Pages\Page                                $page
     * @param \App\Http\Requests\Backend\Pages\DeletePageRequest    $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Page $page, DeletePageRequest $request)
    {
        $this->page->delete($page);

        return new RedirectResponse(route('admin.pages.index'), ['flash_success' => trans('alerts.backend.pages.deleted')]);
    }
}
