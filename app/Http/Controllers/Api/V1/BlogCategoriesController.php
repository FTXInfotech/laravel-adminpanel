<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\BlogCategoriesResource;
use App\Models\BlogCategory;
use App\Repositories\Backend\BlogCategoriesRepository;
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
    public function __construct(BlogCategoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return the blog categories.
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
     * Return the specified resource.
     *
     * @param BlogCategory blogCategory
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(BlogCategory $blogCategory)
    {
        return new BlogCategoriesResource($blogCategory);
    }

    /**
     * Creates the Resource for Blog Categories.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->validateBlogCategories($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        return new BlogCategoriesResource($this->repository->create($request->all()));
    }

    /**
     * Update blog category.
     *
     * @param BlogCategory    $blogCategory
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validation = $this->validateBlogCategories($request, $blogCategory->id);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        return new BlogCategoriesResource($this->repository->update($blogCategory, $request->all()));
    }

    /**
     * Delete Blog Category.
     *
     * @param BlogCategory    $blogCategory
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BlogCategory $blogCategory, Request $request)
    {
        $this->repository->delete($blogCategory);

        return $this->respond([
            'message' => trans('alerts.backend.blog-categories.deleted'),
        ]);
    }

    /**
     * validate Blog Category.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateBlogCategories(Request $request, $id = 0)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:blog_categories,name,'.$id,
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
            'name.required' => 'Please insert Blog Title',
            'name.max'      => 'Blog Title may not be greater than 191 characters.',
        ];
    }
}
