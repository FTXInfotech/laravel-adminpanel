<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Repositories\Backend\Blogs\BlogsRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogsTableController.
 */
class BlogsTableController extends Controller
{
    protected $blogs;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $cmspages
     */
    public function __construct(BlogsRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageBlogsRequest $request)
    {
        return Datatables::of($this->blogs->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($blogs) {
                return $blogs->status;
            })
            ->addColumn('publish_datetime', function ($blogs) {
                return $blogs->publish_datetime->format('d/m/Y h:i A');
            })
            ->addColumn('created_by', function ($blogs) {
                return $blogs->user_name;
            })
            ->addColumn('created_at', function ($blogs) {
                return $blogs->created_at->toDateString();
            })
            ->addColumn('actions', function ($blogs) {
                return $blogs->action_buttons;
            })
            ->make(true);
    }
}
