<?php

namespace App\Http\Controllers\Backend\BlogCategories;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\BlogCategories\BlogCategoriesRepository;
use App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest;
use Carbon\Carbon;

/**
 * Class BlogCategoriesTableController.
 */
class BlogCategoriesTableController extends Controller
{
    /**
     * @var BlogCategoriesRepository
     */
    protected $blogcategories;

    /**
     * @param BlogCategoriesRepository $cmspages
     */
    public function __construct(BlogCategoriesRepository $blogcategories)
    {
        $this->blogcategories = $blogcategories;
    }

    /**
     * @param ManageBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageBlogCategoriesRequest $request)
    {
        return Datatables::of($this->blogcategories->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($blogcategories) {
                if ($blogcategories->status) {
                    return '<span class="label label-success">Active</span>';
                }
                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_by', function ($blogcategories) {
                return $blogcategories->user_name;
            })
            ->addColumn('created_at', function ($blogcategories) {
                return Carbon::parse($blogcategories->created_at)->toDateString();
            })
            ->addColumn('actions', function ($blogcategories) {
                return $blogcategories->action_buttons;
            })
            ->make(true);
    }
}
