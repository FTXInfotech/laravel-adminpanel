<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest;
use App\Http\Resources\BlogTagsResource;
use App\Models\BlogTag;
use App\Repositories\Backend\BlogTagsRepository;
use Illuminate\Http\Response;

/**
 * @group Blog Tag Management
 *
 * Class BlogTagsController
 *
 * APIs for Blog Tag Management
 *
 * @authenticated
 */
class BlogTagsController extends APIController
{
    /**
     * Repository.
     *
     * @var BlogTagsRepository
     */
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
     * Get all Blog Tags.
     *
     * This endpoint provides a paginated list of all blog tags. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam page Which page to show. Example: 12
     * @queryParam per_page Number of records per page. (use -1 to retrieve all) Example: 20
     * @queryParam order_by Order by database column. Example: created_at
     * @queryParam order Order direction ascending (asc) or descending (desc). Example: asc
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-tag/blog-tag-list.json
     *
     * @param ManageBlogTagsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ManageBlogTagsRequest $request)
    {
        $collection = $this->repository->retrieveList($request->all());

        return BlogTagsResource::collection($collection);
    }

    /**
     * Gives a specific Blog Tag.
     *
     * This endpoint provides you a single Blog Tag
     * The Blog Tag is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog Tag
     *
     * @responseFile status=401 scenario="API token not provided" responses/unauthenticated.json
     * @responseFile responses/blog-tag/blog-tag-show.json
     *
     * @param ManageBlogTagsRequest $request
     * @param BlogTag $blogTag
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ManageBlogTagsRequest $request, BlogTag $blogTag)
    {
        return new BlogTagsResource($blogTag);
    }

    /**
     * Create a new Blog Tag.
     *
     * This endpoint lets you create new Blog Tag
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
        return (new BlogTagsResource($this->repository->create($request->validated())))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update Blog Tag.
     *
     * This endpoint allows you to update existing Blog Tag with new data.
     * The Blog Tag to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog Tag
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog-tag/blog-tag-update.json
     *
     * @param UpdateBlogTagsRequest $request
     * @param BlogTag $blogTag
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBlogTagsRequest $request, BlogTag $blogTag)
    {
        $blogTag = $this->repository->update($blogTag, $request->validated());

        return new BlogTagsResource($blogTag);
    }

    /**
     * Delete Blog Tag.
     *
     * This endpoint allows you to delete a Blog Tag
     * The Blog Tag to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog Tag
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=204 scenario="When the record is deleted" responses/blog-tag/blog-tag-destroy.json
     *
     * @param DeleteBlogTagsRequest $request
     * @param BlogTag $blogTag
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteBlogTagsRequest $request, BlogTag $blogTag)
    {
        $this->repository->delete($blogTag);

        return response()->noContent();
    }
}
