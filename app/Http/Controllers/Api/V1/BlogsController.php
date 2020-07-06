<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\BlogsResource;
use App\Models\Blog;
use App\Repositories\Backend\BlogsRepository;
use Illuminate\Http\Request;
use Validator;

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
     * Return the blogs.
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
     * Return the specified resource.
     *
     * @param Blog blog
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Blog $blog)
    {
        return new BlogsResource($blog);
    }

    /**
     * Creates the Resource for Blog.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->validateBlog($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $request['categories'] = explode(',',trim($request->categories));
        $request['tags'] = explode(',',trim($request->tags));

        return new BlogsResource($this->repository->create($request->all()));
    }

    /**
     * Update blog.
     *
     * @param Blog    $blog
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Blog $blog)
    {
        $validation = $this->validateBlog($request, $blog->id, 'update');

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        
        $request['categories'] = explode(',',trim($request->categories));
        $request['tags'] = explode(',',trim($request->tags));

        return new BlogsResource($this->repository->update($blog, $request->all()));
    }

    /**
     * Delete Blog.
     *
     * @param Blog    $blog
     * @param Request $request
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

    /**
     * validate Blog.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateBlog(Request $request, $id = 0, $action = 'insert')
    {
        $featured_image = ($action == 'insert') ? 'required' : '';

        $publish_datetime = $request->publish_datetime !== '' ? 'required|date' : 'required';

        $validation = Validator::make($request->all(), [
            'name'              => 'required|max:191|unique:blogs,name,'.$id,
            'featured_image'    => $featured_image,
            'publish_datetime'  => $publish_datetime,
            'content'           => 'required',
            'categories'        => 'required',
            'tags'              => 'required',
        ]);

        return $validation;
    }

    /**
     * validate message for validate blog.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function messages()
    {
        return [
            'name.required' => 'Please insert Blog Title.',
            'name.unique'   => 'The blog name already taken. Please try with different name.',
            'name.max'      => 'Blog Title may not be greater than 191 characters.',
        ];
    }
}
