<?php

namespace App\Http\Controllers\Backend\BlogTags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogTags\CreateBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\EditBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest;
use App\Http\Responses\Backend\BlogTag\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\BlogTags\BlogTag;
use App\Repositories\Backend\BlogTags\BlogTagsRepository;

/**
 * Class BlogTagsController.
 */
class BlogTagsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\BlogTags\BlogTagsRepository
     */
    protected $blogtag;

    /**
     * @param \App\Repositories\Backend\BlogTags\BlogTagsRepository $blogtag
     */
    public function __construct(BlogTagsRepository $blogtag)
    {
        $this->blogtag = $blogtag;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageBlogTagsRequest $request)
    {
        return new ViewResponse('backend.blogtags.index');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\CreateBlogTagsRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateBlogTagsRequest $request)
    {
        return new ViewResponse('backend.blogtags.create');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreBlogTagsRequest $request)
    {
        $this->blogtag->create($request->except('token'));

        return new RedirectResponse(route('admin.blogTags.index'), ['flash_success' => trans('alerts.backend.blogtags.created')]);
    }

    /**
     * @param \App\Models\BlogTags\BlogTag                            $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\EditBlogTagsRequest $request
     *
     * @return \App\Http\Responses\Backend\BlogTag\EditResponse
     */
    public function edit(BlogTag $blogTag, EditBlogTagsRequest $request)
    {
        return new EditResponse($blogTag);
    }

    /**
     * @param \App\Models\BlogTags\BlogTag                              $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest $request
     *
     * @return mixed
     */
    public function update(BlogTag $blogTag, UpdateBlogTagsRequest $request)
    {
        $this->blogtag->update($blogTag, $request->except(['_method', '_token']));

        return new RedirectResponse(route('admin.blogTags.index'), ['flash_success' => trans('alerts.backend.blogtags.updated')]);
    }

    /**
     * @param \App\Models\BlogTags\BlogTag                              $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest $request
     *
     * @return mixed
     */
    public function destroy(BlogTag $blogTag, DeleteBlogTagsRequest $request)
    {
        $this->blogtag->delete($blogTag);

        return new RedirectResponse(route('admin.blogTags.index'), ['flash_success' => trans('alerts.backend.blogtags.deleted')]);
    }
}
