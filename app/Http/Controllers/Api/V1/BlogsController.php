<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Resources\BlogsResource;
use App\Repositories\Backend\BlogsRepository;
use App\Http\Requests\Backend\Blogs\StoreBlogsRequest;
use App\Http\Requests\Backend\Blogs\UpdateBlogsRequest;

/**
 * @group Blog Management
 *
 * Class BlogsController
 *
 * API's for Blog Management
 *
 * @authenticated
 */
class BlogsController extends APIController
{
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
     * This enpoint provides a paginated list of all blogs. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam paginate Which page to show. Example :12
     * @queryParam orderBy Order by accending or descending. Example :ASC or DESC
     * @queryParam sortBy Sort by any database column. Example :created_at
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog/blog-list.json
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

        return BlogsResource::collection(
            $this->repository->getActivePaginated($limit, $sortBy, $orderBy)
        );
    }

    /**
     * Gives a specific Blog.
     *
     * This endpoint provides you a single Blog.
     * The Blog is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog.
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog/blog-show.json
     *
     * @param \App\Models\Blog blog
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Blog $blog)
    {
        return new BlogsResource($blog);
    }

    /**
     * Create a new Blog.
     *
     * This endpoint lets you careate new Blog
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/blog/blog-store.json
     *
     * @param \App\Http\Requests\Backend\Blogs\StoreBlogsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBlogsRequest $request)
    {
        $request['categories'] = explode(',', trim($request->categories));
        $request['tags'] = explode(',', trim($request->tags));

        return new BlogsResource($this->repository->create($request->all()));
    }

    /**
     * Update Blog.
     *
     * This endpoint allows you to update existing Blog with new data.
     * The Blog to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog.
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
        $request['categories'] = explode(',', trim($request->categories));
        $request['tags'] = explode(',', trim($request->tags));

        return new BlogsResource($this->repository->update($blog, $request->all()));
    }

    /**
     * Delete Blog.
     *
     * This endpoint allows you to delete a Blog.
     * The Blog to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Blog.
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/blog/blog-destroy.json
     *
     * @param \App\Models\Blog $blog
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Blog $blog, Request $request)
    {
        $this->repository->delete($blog);

        return $this->respond([
            'message' => __('alerts.backend.blogs.deleted'),
        ]);
    }
}
