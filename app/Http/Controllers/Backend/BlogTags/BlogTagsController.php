<?php

namespace App\Http\Controllers\Backend\BlogTags;

use App\Models\BlogTags\BlogTag;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\BlogTags\BlogTagsRepository;
use App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\CreateBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\EditBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest;

/**
 * Class BlogTagsController.
 */
class BlogTagsController extends Controller
{
    /**
     * @var BlogTagsRepository
     */
    protected $blogtags;

    /**
     * @param blogtagsRepository $blogtags
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
    public function index(ManageBlogTagsRequest $request)
    {
        return view('backend.blogtags.index');
    }

    /**
     * @param CreateBlogTagsRequest $request
     *
     * @return mixed
     */
    public function create(CreateBlogTagsRequest $request)
    {
        return view('backend.blogtags.create');
    }

    /**
     * @param StoreblogtagsRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogTagsRequest $request)
    {
        $this->blogtags->create($request->all());

        return redirect()->route('admin.blogtags.index')->withFlashSuccess(trans('alerts.backend.blogtags.created'));
    }

    /**
     * @param BlogTag              $blogtag
     * @param EditBlogTagsRequest $request
     *
     * @return mixed
     */
    public function edit(BlogTag $blogtag, EditBlogTagsRequest $request)
    {
        return view('backend.blogtags.edit')
            ->withBlogtag($blogtag);
    }

    /**
     * @param BlogTag              $blogtag
     * @param UpdateblogtagsRequest $request
     *
     * @return mixed
     */
    public function update(BlogTag $blogtag, UpdateBlogTagsRequest $request)
    {
        $this->blogtags->update($blogtag, $request->all());

        return redirect()->route('admin.blogtags.index')->withFlashSuccess(trans('alerts.backend.blogtags.updated'));
    }

    /**
     * @param BlogTag              $blogtag
     * @param DeleteBlogTagsRequest $request
     *
     * @return mixed
     */
    public function destroy(BlogTag $blogtag, DeleteBlogTagsRequest $request)
    {
        $this->blogtags->delete($blogtag);

        return redirect()->route('admin.blogtags.index')->withFlashSuccess(trans('alerts.backend.blogtags.deleted'));
    }
}
