<?php

namespace App\Http\Controllers\Backend\BlogCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogCategories\CreateBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\DeleteBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\EditBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\StoreBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\UpdateBlogCategoriesRequest;
use App\Models\BlogCategories\BlogCategory;
use App\Repositories\Backend\BlogCategories\BlogCategoriesRepository;

/**
 * Class BlogCategoriesController.
 */
class BlogCategoriesController extends Controller
{
    protected $blogcategory;

    /**
     * @param BlogCategoriesRepository $blogcategory
     */
    public function __construct(BlogCategoriesRepository $blogcategory)
    {
        $this->blogcategory = $blogcategory;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function index(ManageBlogCategoriesRequest $request)
    {
        return view('backend.blogcategories.index');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\CreateBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function create(CreateBlogCategoriesRequest $request)
    {
        return view('backend.blogcategories.create');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogCategories\StoreBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogCategoriesRequest $request)
    {
        $this->blogcategory->create($request->all());

        return redirect()
            ->route('admin.blogCategories.index')
            ->with('flash_success', trans('alerts.backend.blogcategories.created'));
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory                             $blogcategory
     * @param \App\Http\Requests\Backend\BlogCategories\EditBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function edit(BlogCategory $blogCategory, EditBlogCategoriesRequest $request)
    {
        return view('backend.blogcategories.edit')
            ->with('blogcategory', $blogCategory);
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory                               $blogcategory
     * @param \App\Http\Requests\Backend\BlogCategories\UpdateBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function update(BlogCategory $blogCategory, UpdateBlogCategoriesRequest $request)
    {
        $this->blogcategory->update($blogCategory, $request->all());

        return redirect()
            ->route('admin.blogCategories.index')
            ->with('flash_success', trans('alerts.backend.blogcategories.updated'));
    }

    /**
     * @param \App\Models\BlogCategories\BlogCategory                               $blogcategory
     * @param \App\Http\Requests\Backend\BlogCategories\DeleteBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function destroy(BlogCategory $blogCategory, DeleteBlogCategoriesRequest $request)
    {
        $this->blogcategory->delete($blogCategory);

        return redirect()
            ->route('admin.blogCategories.index')
            ->with('flash_success', trans('alerts.backend.blogcategories.deleted'));
    }
}
