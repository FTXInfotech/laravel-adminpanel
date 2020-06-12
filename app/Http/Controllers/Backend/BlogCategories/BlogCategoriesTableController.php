<?php

namespace App\Http\Controllers\Backend\BlogCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest;
use App\Repositories\Backend\BlogCategories\BlogCategoriesRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogCategoriesTableController.
 */
class BlogCategoriesTableController extends Controller
{
    protected $blogcategory;

    /**
     * @param \App\Repositories\Backend\BlogCategories\BlogCategoriesRepository $cmspages
     */
    public function __construct(BlogCategoriesRepository $blogcategory)
    {
        $this->blogcategory = $blogcategory;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageBlogCategoriesRequest $request)
    {
        return Datatables::of($this->blogcategory->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($blogcategory) {
                return $blogcategory->status_label;
            })
            ->addColumn('created_by', function ($blogcategory) {
                return $blogcategory->user_name;
            })
            ->addColumn('created_at', function ($blogcategory) {
                return Carbon::parse($blogcategory->created_at)->toDateString();
            })
            ->addColumn('actions', function ($blogcategory) {
                return $blogcategory->action_buttons;
            })
            ->make(true);
    }
}
