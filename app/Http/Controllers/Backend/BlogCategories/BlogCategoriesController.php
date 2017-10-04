<?php

namespace App\Http\Controllers\Backend\BlogCategories;

use App\Models\BlogCategories\BlogCategory;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\BlogCategories\BlogCategoriesRepository;
use App\Http\Requests\Backend\BlogCategories\StoreBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\ManageBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\EditBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\CreateBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\DeleteBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\UpdateBlogCategoriesRequest;

/**
 * Class BlogCategoriesController.
 */
class BlogCategoriesController extends Controller
{
    /**
     * @var BlogCategoriesRepository
     */
    protected $blogcategories;

    /**
     * @param BlogCategoriesRepository $blogcategories
     */
    public function __construct(BlogCategoriesRepository $blogcategories)
    {
        $this->blogcategories = $blogcategories;
    }

    /**
     * @param ManageBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function index(ManageBlogCategoriesRequest $request)
    {
        return view('backend.blogcategories.index');
    }

    /**
     * @param CreateBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function create(CreateBlogCategoriesRequest $request)
    {
        return view('backend.blogcategories.create');
    }

    /**
     * @param StoreBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogCategoriesRequest $request)
    {
        $this->blogcategories->create($request->all());

        return redirect()->route('admin.blogcategories.index')->withFlashSuccess(trans('alerts.backend.blogcategories.created'));
    }

    /**
     * @param BlogCategory              $blogcategory
     * @param EditBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function edit(BlogCategory $blogcategory, EditBlogCategoriesRequest $request)
    {
        return view('backend.blogcategories.edit')
            ->withBlogcategory($blogcategory);
    }

    /**
     * @param BlogCategory              $blogcategory
     * @param UpdateBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function update(BlogCategory $blogcategory, UpdateBlogCategoriesRequest $request)
    {
        $this->blogcategories->update($blogcategory, $request->all());

        return redirect()->route('admin.blogcategories.index')->withFlashSuccess(trans('alerts.backend.blogcategories.updated'));
    }

    /**
     * @param BlogCategory              $blogcategory
     * @param DeleteBlogCategoriesRequest $request
     *
     * @return mixed
     */
    public function destroy(BlogCategory $blogcategory, DeleteBlogCategoriesRequest $request)
    {
        $this->blogcategories->delete($blogcategory);

        return redirect()->route('admin.blogcategories.index')->withFlashSuccess(trans('alerts.backend.blogcategories.deleted'));
    }
}
