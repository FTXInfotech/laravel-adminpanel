<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\BlogTagsResource;
use App\Models\BlogTags\BlogTag;
use App\Repositories\Backend\BlogTags\BlogTagsRepository;
use Illuminate\Http\Request;
use Validator;

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
     * Return the BlogTags.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'ASC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';

        return BlogTagsResource::collection(
            $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param BlogTag $blog_tag
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(BlogTag $blog_tag)
    {
        return new BlogTagsResource($blog_tag);
    }

    /**
     * Creates the Resource for BlogTag.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->validatingRequest($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->create($request->all());

        return new BlogTagsResource(BlogTag::orderBy('created_at', 'desc')->first());
    }

    /**
     * Update BlogTag.
     *
     * @param BlogTag $blog_tag
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, BlogTag $blog_tag)
    {
        $validation = $this->validatingRequest($request, $blog_tag->id);

        if ($validation->fails()) {
            return $this->throwValidation($validation);
        }

        $this->repository->update($blog_tag, $request->all());

        $blog_tag = BlogTag::findOrfail($blog_tag->id);

        return new BlogTagsResource($blog_tag);
    }

    /**
     * Delete BlogTag.
     *
     * @param BlogTag              $blog_tag
     * @param DeleteBlogTagRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BlogTag $blog_tag, Request $request)
    {
        $this->repository->delete($blog_tag);

        return ['message'=>'success'];
    }

    /**
     * validate BlogTag.
     *
     * @param $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validatingRequest(Request $request, $id = 0)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:blog_tags,name,'.$id,
        ]);

        return $validation;
    }
}
