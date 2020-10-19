<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\Faqs\DeleteFaqsRequest;
use App\Http\Requests\Backend\Faqs\ManageFaqsRequest;
use App\Http\Requests\Backend\Faqs\StoreFaqsRequest;
use App\Http\Requests\Backend\Faqs\UpdateFaqsRequest;
use App\Http\Resources\FaqsResource;
use App\Models\Faq;
use App\Repositories\Backend\FaqsRepository;
use Illuminate\Http\Response;

/**
 * @group Faq Management
 *
 * Class FaqsController
 *
 * APIs for Faq Management
 *
 * @authenticated
 */
class FaqsController extends APIController
{
    /**
     * Repository.
     *
     * @var FaqsRepository
     */
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(FaqsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Faq.
     *
     * This endpoint provides a paginated list of all faqs. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam page Which page to show. Example: 12
     * @queryParam per_page Number of records per page. (use -1 to retrieve all) Example: 20
     * @queryParam order_by Order by database column. Example: created_at
     * @queryParam order Order direction ascending (asc) or descending (desc). Example: asc
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/faq/faq-list.json
     *
     * @param ManageFaqsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ManageFaqsRequest $request)
    {
        $collection = $this->repository->retrieveList($request->all());

        return FaqsResource::collection($collection);
    }

    /**
     * Gives a specific Faq.
     *
     * This endpoint provides you a single Faq
     * The Faq is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Faq
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/faq/faq-show.json
     *
     * @param ManageFaqsRequest $request
     * @param \App\Models\Faq $faq
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ManageFaqsRequest $request, Faq $faq)
    {
        return new FaqsResource($faq);
    }

    /**
     * Create a new Faq.
     *
     * This endpoint lets you create new Faq
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/faq/faq-store.json
     *
     * @param \App\Http\Requests\Backend\Faqs\StoreFaqsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFaqsRequest $request)
    {
        return (new FaqsResource($this->repository->create($request->validated())))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update Faq.
     *
     * This endpoint allows you to update existing Faq with new data.
     * The Faq to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Faq
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/faq/faq-update.json
     *
     * @param \App\Models\Faq $faq
     * @param \App\Http\Requests\Backend\Faqs\UpdateFaqsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateFaqsRequest $request, Faq $faq)
    {
        $faq = $this->repository->update($faq, $request->validated());

        return new FaqsResource($faq);
    }

    /**
     * Delete Faq.
     *
     * This endpoint allows you to delete a Faq
     * The Faq to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Faq
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=204 scenario="When the record is deleted" responses/faq/faq-destroy.json
     *
     * @param \App\Models\Faq $faq
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteFaqsRequest $request, Faq $faq)
    {
        $this->repository->delete($faq);

        return response()->noContent();
    }
}
