<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\BlogTagsResource;
use App\Models\BlogTag;
use App\Repositories\Backend\BlogTagsRepository;
use Illuminate\Http\Request;
use Validator;

class BlogCategoriesController extends APIController
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
     * Return the blog tags.
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
     * Return the specified resource.
     *
     * @param BlogTag blogTag
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(BlogTag $blogTag)
    {
        return new BlogTagsResource($blogTag);
    }

    /**
     * Creates the Resource for Blog Tags.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->validateBlogTag($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        return new BlogTagsResource($this->repository->create($request->all()));
    }

    /**
     * Update blog tag.
     *
     * @param BlogTag    $blogTag
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, BlogTag $blogTag)
    {
        $validation = $this->validateBlogTag($request, $blogTag->id);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        return new BlogTagsResource($this->repository->update($blogTag, $request->all()));
    }

    /**
     * Delete Blog Tag.
     *
     * @param BlogTag    $blogTag
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BlogTag $blogTag, Request $request)
    {
        $this->repository->delete($blogTag);

        return $this->respond([
            'message' => __('alerts.backend.blog-tags.deleted'),
        ]);
    }

    /**
     * validate Blog Tag.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateBlogTag(Request $request, $id = 0)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:blog_tags,name,'.$id,
        ]);

        return $validation;
    }

    /**
     * validate message for validate tag.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function messages()
    {
        return [
            'name.required' => 'Please insert Blog Tag',
            'name.unique'   => 'Blog tag name already taken. Please try with different name.',
            'name.max'      => 'Blog tag may not be greater than 191 characters.',
        ];
    }
}
