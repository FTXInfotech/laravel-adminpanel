<?php

namespace App\Http\Controllers\Backend\BlogTags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest;
use App\Repositories\Backend\BlogTags\BlogTagsRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class BlogTagsTableController.
 */
class BlogTagsTableController extends Controller
{
    /**
     * @var BlogTagsRepository
     */
    protected $blogtags;

    /**
     * @param BlogTagsRepository $cmspages
     */
    public function __construct(BlogTagsRepository $blogtags)
    {
        $this->blogtags = $blogtags;
    }

    /**
     * @param ManageBlogTagsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageBlogTagsRequest $request)
    {
        return Datatables::of($this->blogtags->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($blogtags) {
                if ($blogtags->status) {
                    return '<span class="label label-success">Active</span>';
                }

                return '<span class="label label-danger">Inactive</span>';
            })
            ->addColumn('created_by', function ($blogtags) {
                return $blogtags->user_name;
            })
            ->addColumn('created_at', function ($blogtags) {
                return Carbon::parse($blogtags->created_at)->toDateString();
            })
            ->addColumn('actions', function ($blogtags) {
                return $blogtags->action_buttons;
            })
            ->make(true);
    }
}
