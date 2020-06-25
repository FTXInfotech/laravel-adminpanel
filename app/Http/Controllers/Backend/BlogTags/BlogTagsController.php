<?php

namespace App\Http\Controllers\Backend\BlogTags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogTags\CreateBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest;
use App\Http\Responses\ViewResponse;
use App\Repositories\Backend\BlogTags\BlogTagsRepository;
use App\Models\BlogTags\BlogTag;
use App\Http\Responses\Backend\BlogTag\EditResponse;
use App\Http\Responses\RedirectResponse;

class BlogTagsController extends Controller
{
    /**
     * @var BlogTagsRepository
     */
    protected $tag;
    
    /**
     * @param \App\Repositories\Backend\BlogTags\BlogTagsRepository $tag
     */
    public function __construct(BlogTagsRepository $tag)
    {
        $this->tag = $tag;
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
        $this->tag->create($request->except('token'));

        return new RedirectResponse(route('admin.blog-tags.index'), ['flash_success' => trans('alerts.backend.blog-tags.created')]);
    }

    /**
     * @param \App\Models\BlogTags\BlogTag                              $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest $request
     *
     * @return \App\Http\Responses\Backend\BlogTag\EditResponse
     */
    public function edit(BlogTag $blogTag, ManageBlogTagsRequest $request)
    {
        return new EditResponse($blogTag);
    }

    /**
     * @param \App\Models\BlogTags\BlogTag                                $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest   $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(BlogTag $blogTag, UpdateBlogTagsRequest $request)
    {
        $this->tag->update($blogTag, $request->all());

        return new RedirectResponse(route('admin.blog-tags.index'), ['flash_success' => trans('alerts.backend.blog-tags.updated')]);
    }

    /**
     * @param \App\Models\BlogTags\BlogTag                              $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(BlogTag $blogTag, DeleteBlogTagsRequest $request)
    {
        $this->tag->delete($blogTag);

        return new RedirectResponse(route('admin.blog-tags.index'), ['flash_success' => trans('alerts.backend.blog-tags.deleted')]);
    }
}
