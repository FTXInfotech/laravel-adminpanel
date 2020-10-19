<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\Pages\DeletePageRequest;
use App\Http\Requests\Backend\Pages\ManagePageRequest;
use App\Http\Requests\Backend\Pages\StorePageRequest;
use App\Http\Requests\Backend\Pages\UpdatePageRequest;
use App\Http\Resources\PagesResource;
use App\Models\Page;
use App\Repositories\Backend\PagesRepository;
use Illuminate\Http\Response;

/**
 * @group Pages Management
 *
 * Class PagesController
 *
 * APIs for Pages Management
 *
 * @authenticated
 */
class PagesController extends APIController
{
    /**
     * Repository.
     *
     * @var PagesRepository
     */
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
     * Get all Pages.
     *
     * This endpoint provides a paginated list of all pages. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam page Which page to show. Example: 12
     * @queryParam per_page Number of records per page. (use -1 to retrieve all) Example: 20
     * @queryParam order_by Order by database column. Example: created_at
     * @queryParam order Order direction ascending (asc) or descending (desc). Example: asc
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/page/page-list.json
     *
     * @param \Illuminate\Http\ManagePageRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ManagePageRequest $request)
    {
        $collection = $this->repository->retrieveList($request->all());

        return PagesResource::collection($collection);
    }

    /**
     * Gives a specific Page.
     *
     * This endpoint provides you a single Page
     * The Page is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Page
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/page/page-show.json
     *
     * @param ManagePageRequest $request
     * @param \App\Models\Page $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ManagePageRequest $request, Page $page)
    {
        return new PagesResource($page);
    }

    /**
     * Create a new Page.
     *
     * This endpoint lets you create new Page
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
        $page = $this->repository->create($request->validated());

        return (new PagesResource($page))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update Page.
     *
     * This endpoint allows you to update existing Page with new data.
     * The Page to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Page
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
        $page = $this->repository->update($page, $request->validated());

        return new PagesResource($page);
    }

    /**
     * Delete Page.
     *
     * This endpoint allows you to delete a Page
     * The Page to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Page
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=204 scenario="When the record is deleted" responses/page/page-destroy.json
     *
     * @param \App\Models\Page $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeletePageRequest $request, Page $page)
    {
        $this->repository->delete($page);

        return response()->noContent();
    }
}
