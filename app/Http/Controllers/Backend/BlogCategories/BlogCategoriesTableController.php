<?php

namespace App\Http\Controllers\Backend\BlogCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest;
use App\Repositories\Backend\BlogCategoriesRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogCategoriesTableController.
 */
class BlogCategoriesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\BlogCategoriesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\BlogCategories\BlogCategoriesRepository $repository
     */
    public function __construct(BlogCategoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageBlogCategoriesRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->filterColumn('status', function ($query, $keyword) {
                if (in_array(strtolower($keyword), ['active', 'inactive'])) {
                    $query->where('blog_categories.status', (strtolower($keyword) == 'active') ? 1 : 0);
                }
            })
            ->filterColumn('created_by', function ($query, $keyword) {
                $query->whereRaw('users.first_name like ?', ["%{$keyword}%"]);
            })
            ->editColumn('status', function ($blogcategory) {
                return $blogcategory->status_label;
            })
            ->editColumn('created_at', function ($blogcategory) {
                return $blogcategory->created_at->toDateString();
            })
            ->addColumn('actions', function ($blogcategory) {
                return $blogcategory->action_buttons;
            })
            ->escapeColumns(['name'])
            ->make(true);
    }
}
