<?php

namespace App\Http\Controllers\Backend\BlogCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCategories\CreateBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\DeleteBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\StoreBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\UpdateBlogCategoriesRequest;
use App\Http\Responses\ViewResponse;
use App\Repositories\Backend\BlogCategories\BlogCategoriesRepository;
use App\Models\BlogCategories\BlogCategory;
use App\Http\Responses\Backend\BlogCategory\EditResponse;
use App\Http\Responses\RedirectResponse;

class BlogCategoriesController extends Controller
{
    /**
     * @var BlogCategoriesRepository
     */
    protected $category;
    
    /**
     * @param \App\Repositories\Backend\Blogs\BlogsRepository $category
     */
    public function __construct(BlogCategoriesRepository $category)
    {
        $this->category = $category;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageBlogCategoriesRequest $request)
    {
        return new ViewResponse('backend.blog-categories.index');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\CreateBlogCategoriesRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateBlogCategoriesRequest $request)
    {
        return new ViewResponse('backend.blog-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Backend\BlogCategories\StoreBlogCategoriesRequest  $request
     * @return \App\Http\Responses\RedirectResponse 
     */
    public function store(StoreBlogCategoriesRequest $request)
    {
        $this->category->create($request->all());

        return new RedirectResponse(route('admin.blog-categories.index'), ['flash_success' => trans('alerts.backend.blog-category.created')]);
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory             $blogCategory
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return \App\Http\Responses\Backend\BlogCategory\EditResponse
     */
    public function edit(BlogCategory $blogCategory, ManageBlogCategoriesRequest $request)
    {
        return new EditResponse($blogCategory);
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory                               $blogCategory
     * @param \App\Http\Requests\Backend\BlogCategories\UpdateBlogCategoriesRequest   $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(BlogCategory $blogCategory, UpdateBlogCategoriesRequest $request)
    {
        $this->category->update($blogCategory, $request->all());

        return new RedirectResponse(route('admin.blog-categories.index'), ['flash_success' => trans('alerts.backend.blog-category.updated')]);
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory                               $blogCategory
     * @param \App\Http\Requests\Backend\BlogCategories\DeleteBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function destroy(BlogCategory $blogCategory, DeleteBlogCategoriesRequest $request)
    {
        $this->category->delete($blogCategory);

        return new RedirectResponse(route('admin.blog-categories.index'), ['flash_success' => trans('alerts.backend.blog-category.deleted')]);
    }
}
