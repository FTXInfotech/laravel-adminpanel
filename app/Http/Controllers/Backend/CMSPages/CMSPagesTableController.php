<?php

namespace App\Http\Controllers\Backend\CMSPages;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\CMSPages\CMSPagesRepository;
use App\Http\Requests\Backend\CMSPages\ManageCMSPagesRequest;
use Carbon\Carbon;

/**
 * Class CMSPagesTableController.
 */
class CMSPagesTableController extends Controller
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
    public function __invoke(ManageCMSPagesRequest $request)
    {
        return Datatables::of($this->cmspages->getForDataTable())
            ->escapeColumns(['title'])
            ->addColumn('status', function ($cmspages) {
                if ($cmspages->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($cmspages) {
                return Carbon::parse($cmspages->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($cmspages) {
                return Carbon::parse($cmspages->updated_at)->toDateString();
            })
            ->addColumn('actions', function ($cmspages) {
                return $cmspages->action_buttons;
            })
            ->make(true);
    }
}
