<?php

namespace App\Http\Controllers\Backend\BlogTags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BlogTags\CreateBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\EditBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest;
use App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest;
use App\Models\BlogTags\BlogTag;
use App\Repositories\Backend\BlogTags\BlogTagsRepository;

/**
 * Class BlogTagsController.
 */
class BlogTagsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\BlogTags\BlogTagsRepository
     */
    protected $blogtag;

    /**
     * @param \App\Repositories\Backend\BlogTags\BlogTagsRepository $blogtag
     */
    public function __construct(BlogTagsRepository $blogtag)
    {
        $this->blogtag = $blogtag;
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\ManageBlogTagsRequest $request
     *
     * @return mixed
     */
    public function index(ManageBlogTagsRequest $request)
    {
        return view('backend.blogtags.index');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\CreateBlogTagsRequest $request
     *
     * @return mixed
     */
    public function create(CreateBlogTagsRequest $request)
    {
        return view('backend.blogtags.create');
    }

    /**
     * @param \App\Http\Requests\Backend\BlogTags\StoreBlogTagsRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogTagsRequest $request)
    {
        $this->blogtag->create($request->except('token'));

        return redirect()
            ->route('admin.blogtags.index')
            ->with('flash_success', trans('alerts.backend.blogtags.created'));
    }

    /**
     * @param \App\Models\BlogTags\BlogTag                            $blogtag
     * @param \App\Http\Requests\Backend\BlogTags\EditBlogTagsRequest $request
     *
     * @return mixed
     */
    public function edit(BlogTag $blogtag, EditBlogTagsRequest $request)
    {
        return view('backend.blogtags.edit')
            ->with('blogtag', $blogtag);
    }

    /**
     * @param \App\Models\BlogTags\BlogTag                              $blogtag
     * @param \App\Http\Requests\Backend\BlogTags\UpdateBlogTagsRequest $request
     *
     * @return mixed
     */
    public function update(BlogTag $blogtag, UpdateBlogTagsRequest $request)
    {
        $this->blogtag->update($blogtag, $request->except(['_method', '_token']));

        return redirect()
            ->route('admin.blogtags.index')
            ->with('flash_success', trans('alerts.backend.blogtags.updated'));
    }

    /**
     * @param \App\Models\BlogTags\BlogTag                              $blogtag
     * @param \App\Http\Requests\Backend\BlogTags\DeleteBlogTagsRequest $request
     *
     * @return mixed
     */
    public function destroy(BlogTag $blogtag, DeleteBlogTagsRequest $request)
    {
        $this->blogtag->delete($blogtag);

        return redirect()
            ->route('admin.blogtags.index')
            ->with('flash_success', trans('alerts.backend.blogtags.deleted'));
    }
}
