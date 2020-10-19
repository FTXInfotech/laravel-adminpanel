<?php

namespace App\Http\Controllers\Backend\BlogTags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogTags\CreateBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest;
use App\Http\Responses\Backend\BlogTag\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\BlogTag;
use App\Repositories\Backend\BlogTagsRepository;
use Illuminate\Support\Facades\View;

class BlogTagsController extends Controller
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
        View::share('js', ['blog-tags']);
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageBlogTagsRequest $request)
    {
        return new ViewResponse('backend.blog-tags.index');
    }

    /**
     * Show the form for creating a new resource.
     * @param \App\Http\Requests\Backend\BlogTags\CreateBlogTagsRequest
     *
     * @return ViewResponse
     */
    public function create(CreateBlogTagsRequest $request)
    {
        return new ViewResponse('backend.blog-tags.create');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreBlogTagsRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.blog-tags.index'), ['flash_success' => __('alerts.backend.blog-tags.created')]);
    }

    /**
     * @param \App\Models\BlogTag $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest $request
     *
     * @return \App\Http\Responses\Backend\BlogTag\EditResponse
     */
    public function edit(BlogTag $blogTag, ManageBlogTagsRequest $request)
    {
        return new EditResponse($blogTag);
    }

    /**
     * @param \App\Models\BlogTag $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(BlogTag $blogTag, UpdateBlogTagsRequest $request)
    {
        $this->repository->update($blogTag, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.blog-tags.index'), ['flash_success' => __('alerts.backend.blog-tags.updated')]);
    }

    /**
     * @param \App\Models\BlogTag $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(BlogTag $blogTag, DeleteBlogTagsRequest $request)
    {
        $this->repository->delete($blogTag);

        return new RedirectResponse(route('admin.blog-tags.index'), ['flash_success' => __('alerts.backend.blog-tags.deleted')]);
    }
}
