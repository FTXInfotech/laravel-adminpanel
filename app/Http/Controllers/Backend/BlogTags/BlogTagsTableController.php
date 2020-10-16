<?php

namespace App\Http\Controllers\Backend\BlogTags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest;
use App\Repositories\Backend\BlogTagsRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class BlogTagsTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\BlogTagsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\BlogTagsRepository $repository
     */
    public function __construct(BlogTagsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageBlogTagsRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->filterColumn('status', function ($query, $keyword) {
                if (in_array(strtolower($keyword), ['active', 'inactive'])) {
                    $query->where('blog_tags.status', (strtolower($keyword) == 'active') ? 1 : 0);
                }
            })
            ->filterColumn('created_by', function ($query, $keyword) {
                $query->whereRaw('users.first_name like ?', ["%{$keyword}%"]);
            })
            ->addColumn('status', function ($blogtags) {
                return $blogtags->status_label;
            })
            ->addColumn('created_at', function ($blogtags) {
                return Carbon::parse($blogtags->created_at)->toDateString();
            })
            ->addColumn('actions', function ($blogtags) {
                return $blogtags->action_buttons;
            })
            ->escapeColumns(['name'])
            ->make(true);
    }
}
