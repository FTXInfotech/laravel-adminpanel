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
    protected $blogs;

    /**
     * @param BlogsRepository $blogs
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
    public function index(ManageBlogsRequest $request)
    {
        return view('backend.blogs.index')->with([
            'status'=> $this->status,
        ]);
    }

    /**
     * @param ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function create(ManageBlogsRequest $request)
    {
        $blogCategories = BlogCategory::getSelectData();
        $blogTags = BlogTag::getSelectData();

        return view('backend.blogs.create')->with([
            'blogCategories' => $blogCategories,
            'blogTags'       => $blogTags,
            'status'         => $this->status,
        ]);
    }

    /**
     * @param StoreBlogsRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogsRequest $request)
    {
        $input = $request->all();

        $this->blogs->create($input, $tagsArray, $categoriesArray);

        return redirect()->route('admin.blogs.index')->withFlashSuccess(trans('alerts.backend.blogs.created'));
    }

    /**
     * @param Blog               $blog
     * @param ManageBlogsRequest $request
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
     * @param Blog               $blog
     * @param UpdateBlogsRequest $request
     *
     * @return mixed
     */
    public function update(Blog $blog, UpdateBlogsRequest $request)
    {
        $input = $request->all();

        $this->blogs->update($blog, $input);

        return redirect()->route('admin.blogs.index')->withFlashSuccess(trans('alerts.backend.blogs.updated'));
    }

    /**
     * @param Blog               $blog
     * @param ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function destroy(Blog $blog, ManageBlogsRequest $request)
    {
        $this->blogs->delete($blog);

        return redirect()->route('admin.blogs.index')->withFlashSuccess(trans('alerts.backend.blogs.deleted'));
    }
}
