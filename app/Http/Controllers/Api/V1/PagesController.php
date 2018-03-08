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
     * Return the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
       
        return PagesResource::collection(
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
    public function show(Page $page)
    {
        return new PagesResource($page);
    }

    /**
     * Creates the Resourse for Page.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->valiatingRequest($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->create($request->all());

        return new PagesResource(Page::orderBy('created_at', 'desc')->first());
    }

    /**
     * @param Page              $page
     * @param UpdatePageRequest $request
     *
     * @return mixed
     */
    public function update(Request $request, Page $page)
    {
        $validation = $this->valiatingRequest($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($page, $request->all());

        $page = Page::findOrfail($page->id);

        return new PagesResource($page);
    }

    public function valiatingRequest(Request $request)
    {
        
        $validation = Validator::make($request->all(), [
            'title' => 'required|max:191',
            'description' => 'required',
        ]);

        return $validation;
    }

    /**
     * @param Page              $page
     * @param DeletePageRequest $request
     *
     * @return mixed
     */
    public function destroy(Page $page, Request $request)
    {
        $this->repository->delete($page);

        return ['message'=>'success'];
    }
}
