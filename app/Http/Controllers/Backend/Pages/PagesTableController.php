<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Pages\ManagePageRequest;
use App\Repositories\Backend\Pages\PagesRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PagesTableController.
 */
class PagesTableController extends Controller
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
    public function __invoke(ManagePageRequest $request)
    {
        return Datatables::of($this->pages->getForDataTable())
            ->escapeColumns(['title'])
            ->addColumn('status', function ($pages) {
                if ($pages->status) {
                    return '<span class="label label-success">Active</span>';
                }

                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_at', function ($pages) {
                return Carbon::parse($pages->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($pages) {
                return Carbon::parse($pages->updated_at)->toDateString();
            })
            ->addColumn('actions', function ($pages) {
                return $pages->action_buttons;
            })
            ->make(true);
    }
}
