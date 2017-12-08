<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;
use App\Models\BlogCategories\BlogCategory;
use App\Models\Blogs\Blog;
use App\Models\BlogTags\BlogTag;
use App\Repositories\Backend\Blogs\BlogsRepository;

/**
 * Class BlogsController.
 */
class BlogsController extends Controller
{
    /**
     * Blog Status.
     */
    protected $status = [
        'Published' => 'Published',
        'Draft'     => 'Draft',
        'Inactive'  => 'Inactive',
        'Scheduled' => 'Scheduled',
    ];

    /**
     * @var BlogsRepository
     */
    protected $blog;

    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $blog
     */
    public function __construct(BlogsRepository $blog)
    {
        $this->blog = $blog;
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function index(ManageBlogsRequest $request)
    {
        return view('backend.blogs.index')->with([
            'status'=> $this->status,
        ]);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function create(ManageBlogsRequest $request)
    {
        $blogTags       = BlogTag::getSelectData();
        $blogCategories = BlogCategory::getSelectData();

        return view('backend.blogs.create')->with([
            'blogCategories' => $blogCategories,
            'blogTags'       => $blogTags,
            'status'         => $this->status,
        ]);
    }

    /**
     * @param \App\Http\Requests\Backend\Blogs\StoreBlogsRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogsRequest $request)
    {
        $this->blog->create($request->except('_token'));

        return redirect()
            ->route('admin.blogs.index')
            ->with('flash_success', trans('alerts.backend.blogs.created'));
    }

    /**
     * @param \App\Models\Blogs\Blog               $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function edit(Blog $blog, ManageBlogsRequest $request)
    {
        $blogCategories = BlogCategory::getSelectData();
        $blogTags = BlogTag::getSelectData();

        $selectedCategories = $blog->categories->pluck('id')->toArray();
        $selectedtags = $blog->tags->pluck('id')->toArray();

        return view('backend.blogs.edit')->with([
            'blog'               => $blog,
            'blogCategories'     => $blogCategories,
            'blogTags'           => $blogTags,
            'selectedCategories' => $selectedCategories,
            'selectedtags'       => $selectedtags,
            'status'             => $this->status,
        ]);
    }

    /**
     * @param \App\Models\Blogs\Blog               $blog
     * @param \App\Http\Requests\Backend\Blogs\UpdateBlogsRequest $request
     *
     * @return mixed
     */
    public function update(Blog $blog, UpdateBlogsRequest $request)
    {
        $input = $request->all();

        $this->blog->update($blog, $request->except(['_token', '_method']));

        return redirect()
            ->route('admin.blogs.index')
            ->with('flash_success', trans('alerts.backend.blogs.updated'));
    }

    /**
     * @param \App\Models\Blogs\Blog               $blog
     * @param \App\Http\Requests\Backend\Blogs\ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function destroy(Blog $blog, ManageBlogsRequest $request)
    {
        $this->blog->delete($blog);

        return redirect()
            ->route('admin.blogs.index')
            ->with('flash_success', trans('alerts.backend.blogs.deleted'));
    }
}
