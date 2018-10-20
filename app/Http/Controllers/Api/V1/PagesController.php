<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\PagesResource;
use App\Models\Page\Page;
use App\Repositories\Backend\Pages\PagesRepository;
use Illuminate\Http\Request;
use Validator;

class PagesController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(PagesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return the pages.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'ASC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : config('module.pages.table', 'pages').'created_at';

        return PagesResource::collection(
            $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param Pages $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Page $page)
    {
        return new PagesResource($page);
    }

    /**
     * Creates the Resource for Page.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->validatePages($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $page = $this->repository->create($request->all());

        return new PagesResource($page);
    }

    /**
     *  Update Page.
     *
     * @param Page    $page
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Page $page)
    {
        $validation = $this->validatePages($request, $page->id);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($page, $request->all());

        $page = Page::findOrfail($page->id);

        return new PagesResource($page);
    }

    /**
     *  Delete Page.
     *
     * @param Page              $page
     * @param DeletePageRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Page $page, Request $request)
    {
        $this->repository->delete($page);

        return $this->respond([
            'message' => trans('alerts.backend.pages.deleted'),
        ]);
    }

    /**
     * validateUser Pages Requests.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function validatePages(Request $request, $id = 0)
    {
        $validation = Validator::make($request->all(), [
            'title'       => 'required|max:191|unique:pages,title,'.$id,
            'description' => 'required',
        ]);

        return $validation;
    }
}
