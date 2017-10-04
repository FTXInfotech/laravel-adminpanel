<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Blogs\BlogsRepository;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use Carbon\Carbon;

/**
 * Class BlogsTableController.
 */
class BlogsTableController extends Controller
{
    /**
     * @var BlogsRepository
     */
    protected $blogs;

    /**
     * @param BlogsRepository $cmspages
     */
    public function __construct(BlogsRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    /**
     * @param ManageBlogsRequest $request
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
                return Carbon::parse($blogs->publish_datetime)->format("d/m/Y h:i A");
            })
            ->addColumn('created_by', function ($blogs) {
                return $blogs->user_name;
            })
            ->addColumn('created_at', function ($blogs) {
                return Carbon::parse($blogs->created_at)->toDateString();
            })
            ->addColumn('actions', function ($blogs) {
                return $blogs->action_buttons;
            })
            ->make(true);
    }
}
