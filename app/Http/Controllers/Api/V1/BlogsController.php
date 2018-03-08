<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\BlogsResource;
use App\Models\Blogs\Blog;
use App\Repositories\Backend\Blogs\BlogsRepository;
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
     * Return the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;

        return BlogsResource::collection(
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
    public function show(Blog $blog)
    {
        return new BlogsResource($blog);
    }

    /**
     * Creates the Resource for Blog.
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

        return new BlogsResource(Blog::orderBy('created_at', 'desc')->first());
    }

    /**
     * @param Blog              $blog
     * @param UpdateBlogRequest $request
     *
     * @return mixed
     */
    public function update(Request $request, Blog $blog)
    {
        $validation = $this->validatingRequest($request, 'update');

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($blog, $request->all());

        $blog = Blog::findOrfail($blog->id);

        return new BlogsResource($blog);
    }

    public function validatingRequest(Request $request, $type = 'insert')
    {
        $featured_image = ($type == 'insert') ? 'required' : '';

        $validation = Validator::make($request->all(), [
            'name'           => 'required|max:191',
            'featured_image' => $featured_image,
            'content'        => 'required',
            'categories'     => 'required',
            'tags'           => 'required',
        ]);

        return $validation;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert Blog Title',
            'name.max'      => 'Blog Title may not be greater than 191 characters.',
        ];
    }

    /**
     * @param Blog              $blog
     * @param DeleteBlogRequest $request
     *
     * @return mixed
     */
    public function destroy(Blog $blog, Request $request)
    {
        $this->repository->delete($blog);

        return ['message'=>'success'];
    }
}
