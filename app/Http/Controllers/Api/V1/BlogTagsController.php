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
     * Return the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;

        return BlogTagsResource::collection(
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
    public function show(BlogTag $blog_tag)
    {
        return new BlogTagsResource($blog_tag);
    }

    /**
     * Creates the Resource for BlogTag.
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

        return new BlogTagsResource(BlogTag::orderBy('created_at', 'desc')->first());
    }

    /**
     * @param BlogTag              $blog_tag
     * @param UpdateBlogTagRequest $request
     *
     * @return mixed
     */
    public function update(Request $request, BlogTag $blog_tag)
    {
        $validation = $this->validatingRequest($request, $blog_tag->id);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($blog_tag, $request->all());

        $blog_tag = BlogTag::findOrfail($blog_tag->id);

        return new BlogTagsResource($blog_tag);
    }

    public function validatingRequest(Request $request, $id = 0)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:blog_tags,name,'.$id,
        ]);

        return $validation;
    }

    /**
     * @param BlogTag              $blog_tag
     * @param DeleteBlogTagRequest $request
     *
     * @return mixed
     */
    public function destroy(BlogTag $blog_tag, Request $request)
    {
        $this->repository->delete($blog_tag);

        return ['message'=>'success'];
    }
}
