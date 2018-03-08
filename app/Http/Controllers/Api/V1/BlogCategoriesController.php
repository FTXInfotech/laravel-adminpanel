<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\BlogCategoriesResource;
use App\Models\BlogCategories\BlogCategory;
use App\Repositories\Backend\BlogCategories\BlogCategoriesRepository;
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
     * Return the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;

        return BlogCategoriesResource::collection(
            $this->repository->getForDataTable()->paginate($limit)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blog_category)
    {
        return new BlogCategoriesResource($blog_category);
    }

    /**
     * Creates the Resource for BlogCategory.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validatingRequest($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->create($request->all());

        return new BlogCategoriesResource(BlogCategory::orderBy('created_at', 'desc')->first());
    }

    /**
     * @param BlogCategory              $blog_category
     * @param UpdateBlogCategoryRequest $request
     *
     * @return mixed
     */
    public function update(Request $request, BlogCategory $blog_category)
    {
        $validation = $this->validatingRequest($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($blog_category, $request->all());

        $blog_category = BlogCategory::findOrfail($blog_category->id);

        return new BlogCategoriesResource($blog_category);
    }

    public function validatingRequest(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:191',
        ]);

        return $validation;
    }

    /**
     * @param BlogCategory              $blog_category
     * @param DeleteBlogCategoryRequest $request
     *
     * @return mixed
     */
    public function destroy(BlogCategory $blog_category, Request $request)
    {
        $this->repository->delete($blog_category);

        return ['message'=>'success'];
    }
}
