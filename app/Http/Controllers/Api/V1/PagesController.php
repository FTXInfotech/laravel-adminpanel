<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\Pages\StorePageRequest;
use App\Http\Requests\Backend\Pages\UpdatePageRequest;
use App\Http\Resources\PagesResource;
use App\Models\Page;
use App\Repositories\Backend\PagesRepository;
use Illuminate\Http\Request;
use Validator;

/**
 * @group Pages Management
 * 
 * Class PagesController
 * 
 * API's for Pages Management
 * 
 * @authenticated
 */
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
     * Get all Pages
     * 
     * This enpoint provides a paginated list of all pages. You can customize how many records you want in each 
     * returned response as well as sort records based on a key in specific order.     
     * 
     * @queryParam paginate Which page to show. Example :12
     * @queryParam orderBy Order by accending or descending. Example :ASC or DESC
     * @queryParam sortBy Sort by any database column. Example :created_at
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/page/page-list.json
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'ASC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : config('module.pages.table', 'pages').'.created_at';

        return PagesResource::collection(
            $this->repository->getActivePaginated($limit, $sortBy, $orderBy)
        );
    }

    /**
     * Gives a specific Page
     *
     * This endpoint provides you a single Page.
     * The Page is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Page.
     * 
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/page/page-show.json
     *
     * @param \App\Models\Page $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Page $page)
    {
        return new PagesResource($page);
    }

    /**
     * Create a new Page
     *
     * This endpoint lets you careate new Page
     * 
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/page/page-store.json
     *
     * @param \App\Http\Requests\Backend\Pages\StorePageRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePageRequest $request)
    {
        return new PagesResource($this->repository->create($request->all()));
    }

    /**
     * Update Page
     *
     * This endpoint allows you to update existing Page with new data.
     * The Page to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Page.
     * 
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/page/page-update.json
     * 
     * @param \App\Models\Page $page
     * @param \App\Http\Requests\Backend\Pages\UpdatePageRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        return new PagesResource($this->repository->update($page, $request->all()));
    }

    /**
     * Delete Page
     *
     * This endpoint allows you to delete a Page.
     * The Page to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Page.
     * 
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/page/page-destroy.json
     * 
     * @param \App\Models\Page $page
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Page $page)
    {
        $this->repository->delete($page);

        return $this->respond([
            'message' => __('alerts.backend.pages.deleted'),
        ]);
    }
}
