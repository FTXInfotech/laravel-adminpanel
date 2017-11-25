<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Models\Page\Page;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Pages\PagesRepository;
use App\Http\Requests\Backend\Pages\EditPageRequest;
use App\Http\Requests\Backend\Pages\StorePageRequest;
use App\Http\Requests\Backend\Pages\CreatePageRequest;
use App\Http\Requests\Backend\Pages\DeletePageRequest;
use App\Http\Requests\Backend\Pages\ManagePageRequest;
use App\Http\Requests\Backend\Pages\UpdatePageRequest;

/**
 * Class PagesController.
 */
class PagesController extends Controller
{
    /**
     * @var PagesRepository
     */
    protected $pages;

    /**
     * @param PagesRepository $pages
     */
    public function __construct(PagesRepository $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @param ManagePageRequest $request
     *
     * @return mixed
     */
    public function index(ManagePageRequest $request)
    {
        return view('backend.pages.index');
    }

    /**
     * @param CreatePageRequest $request
     *
     * @return mixed
     */
    public function create(CreatePageRequest $request)
    {
        return view('backend.pages.create');
    }

    /**
     * @param StorePageRequest $request
     *
     * @return mixed
     */
    public function store(StorePageRequest $request)
    {
        $this->pages->create($request->all());

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.created'));
    }

    /**
     * @param Page             $page
     * @param EditPageRequest $request
     *
     * @return mixed
     */
    public function edit(Page $page, EditPageRequest $request)
    {
        return view('backend.pages.edit')
            ->withCmspage($page);
    }

    /**
     * @param Page             $page
     * @param UpdatePageRequest $request
     *
     * @return mixed
     */
    public function update(Page $page, UpdatePageRequest $request)
    {
        $this->pages->update($page, $request->all());

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.updated'));
    }

    /**
     * @param Page            $page
     * @param DeletePageRequest $request
     *
     * @return mixed
     */
    public function destroy(Page $page, DeletePageRequest $request)
    {
        $this->pages->delete($page);

        return redirect()->route('admin.pages.index')->withFlashSuccess(trans('alerts.backend.pages.deleted'));
    }
}
