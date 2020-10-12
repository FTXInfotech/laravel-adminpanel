<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Resources\BlogCategoriesResource;
use App\Repositories\Backend\BlogCategoriesRepository;
use App\Http\Requests\Backend\BlogCategories\StoreBlogCategoriesRequest;
use App\Http\Requests\Backend\BlogCategories\UpdateBlogCategoriesRequest;

/**
 * @group Blog Categories Management
 *
 * Class BlogCategoriesController
 *
 * API's for Blog Categories Management
 *
 * @authenticated
 */
class BlogCategoriesController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(BlogCategoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Blog Categories.
     *
     * This enpoint provides a paginated list of all blog categories. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam paginate Which page to show. Example :12
     * @queryParam orderBy Order by accending or descending. Example :ASC or DESC
     * @queryParam sortBy Sort by any database column. Example :created_at
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-category/blog-category-list.json
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'ASC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';

        return BlogCategoriesResource::collection(
            $this->repository->getActivePaginated($limit, $sortBy, $orderBy)
        );
    }

    /**
     * Gives a specific Blog Category.
     *
     * This endpoint provides you a single Blog Category.
     * The Blog Category is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog Category.
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-category/blog-category-show.json
     *
     * @param \App\Models\BlogCategory $blogCategory
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(BlogCategory $blogCategory)
    {
        return new BlogCategoriesResource($blogCategory);
    }

    /**
     * Create a new Blog Category.
     *
     * This endpoint lets you careate new Blog Category
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/blog-category/blog-category-store.json
     *
     * @param \App\Http\Requests\Backend\BlogCategories\StoreBlogCategoriesRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBlogCategoriesRequest $request)
    {
        return new BlogCategoriesResource($this->repository->create($request->all()));
    }

    /**
     * Update Blog Category.
     *
     * This endpoint allows you to update existing Blog Category with new data.
     * The Blog Category to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog Category.
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-category/blog-category-update.json
     *
     * @param \App\Models\BlogCategory $blogCategory
     * @param \App\Http\Requests\Backend\BlogCategories\UpdateBlogCategoriesRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBlogCategoriesRequest $request, BlogCategory $blogCategory)
    {
        return new BlogCategoriesResource($this->repository->update($blogCategory, $request->all()));
    }

    /**
     * Delete Blog Category.
     *
     * This endpoint allows you to delete a Blog Category.
     * The Blog Category to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog Category.
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-category/blog-category-destroy.json
     *
     * @param \App\Models\BlogCategory $blogCategory
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $this->repository->delete($blogCategory);

        return $this->respond([
            'message' => __('alerts.backend.blog-category.deleted'),
        ]);
    }
}
