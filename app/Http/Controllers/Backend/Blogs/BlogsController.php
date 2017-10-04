<?php

namespace App\Http\Controllers\Backend\Blogs;

use App\Models\Blogs\Blog;
use App\Models\BlogTags\BlogTag;
use App\Models\BlogCategories\BlogCategory;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Blogs\BlogsRepository;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;

/**
 * Class BlogsController.
 */
class BlogsController extends Controller
{
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
        $status = [
            "Published" => "Published",
            "Draft" => "Draft",
            "Inactive" => "Inactive",
            "Scheduled" => "Scheduled"
        ];

        return view('backend.blogs.index', compact('status'));
    }

    /**
     * @param ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function create(ManageBlogsRequest $request)
    {
        $blogCategories = BlogCategory::where('status', 1)->pluck('name', 'id');
        $blogTags = BlogTag::where('status', 1)->pluck('name', 'id');
        $status = [
            "Published" => "Published",
            "Draft" => "Draft",
            "Inactive" => "Inactive",
            "Scheduled" => "Scheduled"
        ];

        return view('backend.blogs.create', compact("blogCategories", "blogTags", "status"));
    }

    /**
     * @param StoreBlogsRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogsRequest $request)
    {
        $input = $request->all();
        $tagsArray = $this->createTagsArray($input['tags']);
        $categoriesArray = $this->createCategoriesArray($input['categories']);
        $this->blogs->create($input, $tagsArray, $categoriesArray);

        return redirect()->route('admin.blogs.index')->withFlashSuccess(trans('alerts.backend.blogs.created'));
    }

    /**
     * @param Blog              $blog
     * @param ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function edit(Blog $blog, ManageBlogsRequest $request)
    {
        $blogCategories = BlogCategory::where('status', 1)->pluck('name', 'id');
        $blogTags = BlogTag::where('status', 1)->pluck('name', 'id');
        $status = [
            "Published" => "Published",
            "Draft" => "Draft",
            "InActive" => "InActive",
            "Scheduled" => "Scheduled"
        ];
        $selectedCategories = $blog->categories->pluck('id')->toArray();
        $selectedtags       = $blog->tags->pluck('id')->toArray();

        return view('backend.blogs.edit', compact(
                "blogCategories",
                "blogTags",
                "status",
                "selectedCategories",
                "selectedtags")
            )
            ->withBlog($blog);
    }

    /**
     * @param Blog              $blog
     * @param UpdateBlogsRequest $request
     *
     * @return mixed
     */
    public function update(Blog $blog, UpdateBlogsRequest $request)
    {
        $input = $request->all();
        $tagsArray = $this->createTagsArray($input['tags']);
        $categoriesArray = $this->createCategoriesArray($input['categories']);

        $this->blogs->update($blog, $input, $tagsArray, $categoriesArray);

        return redirect()->route('admin.blogs.index')->withFlashSuccess(trans('alerts.backend.blogs.updated'));
    }

    /**
     * @param Blog              $blog
     * @param ManageBlogsRequest $request
     *
     * @return mixed
     */
    public function destroy(Blog $blog, ManageBlogsRequest $request)
    {
        $this->blogs->delete($blog);

        return redirect()->route('admin.blogs.index')->withFlashSuccess(trans('alerts.backend.blogs.deleted'));
    }

    /**
     * Creating Tags Array
     *
     * @param Array($tags)
     * @return Array
     */
    public function createTagsArray($tags)
    {
        //Creating a new array for tags (newly created)
        $tags_array = [];

        foreach($tags as $tag)
        {
            if(is_numeric($tag))
            {
                $tags_array[] = $tag;
            }
            else
            {
                $newTag = BlogTag::create(['name'=>$tag,'status'=>1,'created_by'=>1]);
                $tags_array[] = $newTag->id;
            }
        }

        return $tags_array;
    }

     /**
     * Creating Tags Array
     *
     * @param Array($tags)
     * @return Array
     */
    public function createCategoriesArray($categories)
    {
        //Creating a new array for categories (newly created)
        $categories_array = [];

        foreach($categories as $category)
        {
            if(is_numeric($category))
            {
                $categories_array[] = $category;
            }
            else
            {
                $newCategory = BlogCategory::create(['name' => $category,'status' => 1,'created_by' => 1]);

                $categories_array[] = $newCategory->id;
            }
        }

        return $categories_array;
    }
}
