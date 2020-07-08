<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest;
use App\Http\Resources\BlogTagsResource;
use App\Models\BlogTag;
use App\Repositories\Backend\BlogTagsRepository;
use Illuminate\Http\Request;

/**
 * @group Blog Tag Management
 * 
 * Class BlogTagsController
 * 
 * API's for Blog Tag Management
 * 
 * @authenticated
 */
class BlogTagsController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(BlogTagsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Blog Tag
     * 
     * This enpoint provides a paginated list of all blog tags. You can customize how many records you want in each 
     * returned response as well as sort records based on a key in specific order.     
     * 
     * @queryParam paginate Which page to show. Example :12
     * @queryParam orderBy Order by accending or descending. Example :ASC or DESC
     * @queryParam sortBy Sort by any database column. Example :created_at
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-tag/blog-tag-list.json
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

        return BlogTagsResource::collection(
            $this->repository->getActivePaginated($limit, $sortBy, $orderBy)
        );
    }

    /**
     * Gives a specific Blog Tag
     *
     * This endpoint provides you a single Blog Tag.
     * The Blog Tag is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog Tag.
     * 
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-tag/blog-tag-show.json
     *
     * @param \App\Models\BlogTag blogTag
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(BlogTag $blogTag)
    {
        return new BlogTagsResource($blogTag);
    }

    /**
     * Create a new Blog Tag
     *
     * This endpoint lets you careate new Blog Tage
     * 
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-tag/blog-tag-store.json
     *
     * @param \App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBlogTagsRequest $request)
    {
        return new BlogTagsResource($this->repository->create($request->all()));
    }

    /**
     * Update Blog Tag
     *
     * This endpoint allows you to update existing Blog Tag with new data.
     * The Blog Tag to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog Tag.
     * 
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-tag/blog-tag-update.json
     * 
     * @param \App\Models\BlogTag $blogTag
     * @param \App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBlogTagsRequest $request, BlogTag $blogTag)
    {
        return new BlogTagsResource($this->repository->update($blogTag, $request->all()));
    }

    /**
     * Delete Blog Category
     *
     * This endpoint allows you to delete a Blog Category.
     * The Blog Category to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog Category.
     * 
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-tag/blog-tag-destroy.json
     * 
     * @param \App\Models\BlogTag $blogTag
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BlogTag $blogTag)
    {
        $this->repository->delete($blogTag);

        return $this->respond([
            'message' => __('alerts.backend.blog-tags.deleted'),
        ]);
    }
}
