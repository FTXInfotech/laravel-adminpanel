<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Pages\ManagePageRequest;
use App\Repositories\Backend\Pages\PagesRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PagesTableController.
 */
class PagesTableController extends Controller
{
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
            ->addColumn('status', function ($page) {
                return $page->status_label;
            })
            ->addColumn('created_at', function ($page) {
                return $page->created_at->toDateString();
            })
            ->addColumn('created_by', function ($page) {
                return $page->created_by;
            })
            ->addColumn('actions', function ($page) {
                return $page->action_buttons;
            })
            ->make(true);
    }
}
