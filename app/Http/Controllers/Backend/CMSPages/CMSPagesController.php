<?php

namespace App\Http\Controllers\Backend\CMSPages;

use App\Models\CMSPages\CMSPage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\CMSPages\CMSPagesRepository;
use App\Http\Requests\Backend\CMSPages\StoreCMSPagesRequest;
use App\Http\Requests\Backend\CMSPages\ManageCMSPagesRequest;
use App\Http\Requests\Backend\CMSPages\CreateCMSPagesRequest;
use App\Http\Requests\Backend\CMSPages\EditCMSPagesRequest;
use App\Http\Requests\Backend\CMSPages\DeleteCMSPagesRequest;
use App\Http\Requests\Backend\CMSPages\UpdateCMSPagesRequest;

/**
 * Class CMSPagesController.
 */
class CMSPagesController extends Controller
{
    /**
     * @var CMSPagesRepository
     */
    protected $cmspages;

    /**
     * @param CMSPagesRepository $cmspages
     */
    public function __construct(CMSPagesRepository $cmspages)
    {
        $this->cmspages = $cmspages;
    }

    /**
     * @param ManageCMSPagesRequest $request
     *
     * @return mixed
     */
    public function index(ManageCMSPagesRequest $request)
    {
        return view('backend.cmspages.index');
    }

    /**
     * @param CreateCMSPagesRequest $request
     *
     * @return mixed
     */
    public function create(CreateCMSPagesRequest $request)
    {
        return view('backend.cmspages.create');
    }

    /**
     * @param StoreCMSPagesRequest $request
     *
     * @return mixed
     */
    public function store(StoreCMSPagesRequest $request)
    {
        $this->cmspages->create($request->all());

        return redirect()->route('admin.cmspages.index')->withFlashSuccess(trans('alerts.backend.cmspages.created'));
    }

    /**
     * @param CMSPage              $cmspage
     * @param EditCMSPagesRequest $request
     *
     * @return mixed
     */
    public function edit(CMSPage $cmspage, EditCMSPagesRequest $request)
    {
        return view('backend.cmspages.edit')
            ->withCmspage($cmspage);
    }

    /**
     * @param CMSPage              $cmspage
     * @param EditCMSPagesRequest $request
     *
     * @return mixed
     */
    public function update(CMSPage $cmspage, UpdateCMSPagesRequest $request)
    {
        $this->cmspages->update($cmspage, $request->all());

        return redirect()->route('admin.cmspages.index')->withFlashSuccess(trans('alerts.backend.cmspages.updated'));
    }

    /**
     * @param Permission              $permission
     * @param DeleteCMSPagesRequest $request
     *
     * @return mixed
     */
    public function destroy(CMSPage $cmspage, DeleteCMSPagesRequest $request)
    {
        $this->cmspages->delete($cmspage);

        return redirect()->route('admin.cmspages.index')->withFlashSuccess(trans('alerts.backend.cmspages.deleted'));
    }
}
