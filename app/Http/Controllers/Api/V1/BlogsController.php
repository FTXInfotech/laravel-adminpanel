<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\Blogs\DeleteBlogsRequest;
use App\Http\Requests\Backend\Blogs\ManageBlogsRequest;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;
use App\Http\Resources\BlogsResource;
use App\Models\Blog;
use App\Repositories\Backend\BlogsRepository;
use Illuminate\Http\Response;

/**
 * @group Blog Management
 *
 * Class BlogsController
 *
 * APIs for Blog Management
 *
 * @authenticated
 */
class BlogsController extends APIController
{
    /**
     * Repository.
     *
     * @var BlogsRepository
     */
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(BlogsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Blogs.
     *
     * This endpoint provides a paginated list of all blogs. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam page Which page to show. Example: 12
     * @queryParam per_page Number of records per page. (use -1 to retrieve all) Example: 20
     * @queryParam order_by Order by database column. Example: created_at
     * @queryParam order Order direction ascending (asc) or descending (desc). Example: asc
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog/blog-list.json
     *
     * @param ManageBlogsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ManageBlogsRequest $request)
    {
        $collection = $this->repository->retrieveList($request->all());

        return BlogsResource::collection($collection);
    }

    /**
     * Gives a specific Blog.
     *
     * This endpoint provides you a single Blog
     * The Blog is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog/blog-show.json
     *
     * @param \App\Models\Blog blog
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ManageBlogsRequest $request, Blog $blog)
    {
        return new BlogsResource($blog);
    }

    /**
     * Create a new Blog.
     *
     * This endpoint lets you create new Blog
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/blog/blog-store.json
     *
     * @param StoreBlogsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBlogsRequest $request)
    {
        return (new BlogsResource($this->repository->create($request->validated())))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update Blog.
     *
     * This endpoint allows you to update existing Blog with new data.
     * The Blog to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog/blog-update.json
     *
     * @param \App\Models\Blog $blog
     * @param \App\Http\Requests\Backend\Blogs\UpdateBlogsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBlogsRequest $request, Blog $blog)
    {
        return new BlogsResource($this->repository->update($blog, $request->validated()));
    }

    /**
     * Delete Blog.
     *
     * This endpoint allows you to delete a Blog
     * The Blog to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=204 scenario="When the record is deleted" responses/blog/blog-destroy.json
     *
     * @param DeleteBlogsRequest $request
     * @param \App\Models\Blog $blog
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteBlogsRequest $request, Blog $blog)
    {
        $this->repository->delete($blog);

        return response()->noContent();
    }
}
