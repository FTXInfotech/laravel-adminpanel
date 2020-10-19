<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;
use App\Http\Responses\Backend\Blog\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Repositories\Backend\BlogsRepository;
use Illuminate\Support\Facades\View;

class BlogsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\BlogsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\BlogsRepository $blog
     */
    public function __construct(BlogsRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['blogs']);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageBlogsRequest $request)
    {
        return new ViewResponse('backend.blogs.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return ViewResponse
     */
    public function create(ManageBlogsRequest $request, Blog $blog)
    {
        $blogTags = BlogTag::getSelectData();
        $blogCategories = BlogCategory::getSelectData();

        return new ViewResponse('backend.blogs.create', ['status' => $blog->statuses, 'blogCategories' => $blogCategories, 'blogTags' => $blogTags]);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\StoreBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreBlogsRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => __('alerts.backend.blogs.created')]);
    }

    /**
     * @param \App\Models\Blog $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Blog $blog, ManageBlogsRequest $request)
    {
        $blogCategories = BlogCategory::getSelectData();
        $blogTags = BlogTag::getSelectData();

        return new EditResponse($blog, $blog->statuses, $blogCategories, $blogTags);
    }

    /**
     * @param \App\Models\Blogs\Blog $blog
     * @param \App\Http\Requests\Backend\Blogs\UpdateBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Blog $blog, UpdateBlogsRequest $request)
    {
        $this->repository->update($blog, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => __('alerts.backend.blogs.updated')]);
    }

    /**
     * @param \App\Models\Blog $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Blog $blog, ManageBlogsRequest $request)
    {
        $this->repository->delete($blog);

        return new RedirectResponse(route('admin.blogs.index'), ['flash_success' => __('alerts.backend.blogs.deleted')]);
    }
}
