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
            ->filterColumn('status', function ($query, $keyword) {
                if(in_array(strtolower($keyword), ['active', 'inactive'])) {
                    $query->where('pages.status',(strtolower($keyword) == 'active') ? 1 : 0);
                }
            })
            ->filterColumn('created_by', function ($query, $keyword) {
                $query->whereRaw("users.first_name like ?", ["%{$keyword}%"]);
            })
            ->editColumn('status', function ($page) {
                return $page->status_label;
            })
            ->editColumn('created_at', function ($page) {
                return $page->created_at->toDateString();
            })
            ->addColumn('actions', function ($page) {
                return $page->action_buttons;
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
