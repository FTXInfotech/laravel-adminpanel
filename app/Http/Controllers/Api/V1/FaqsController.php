<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Resources\FaqsResource;
use App\Repositories\Backend\FaqsRepository;
use App\Http\Requests\Backend\Faqs\StoreFaqsRequest;
use App\Http\Requests\Backend\Faqs\UpdateFaqsRequest;

/**
 * @group Faq Management
 *
 * Class FaqsController
 *
 * API's for Faq Management
 *
 * @authenticated
 */
class FaqsController extends APIController
{
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
     * This enpoint provides a paginated list of all faqs. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam paginate Which page to show. Example :12
     * @queryParam orderBy Order by accending or descending. Example :ASC or DESC
     * @queryParam sortBy Sort by any database column. Example :created_at
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/faq/faq-list.json
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'ASC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';

        return FaqsResource::collection(
            $this->repository->getActivePaginated($limit, $sortBy, $orderBy)
        );
    }

    /**
     * Gives a specific Faq.
     *
     * This endpoint provides you a single Faq.
     * The Faq is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Faq.
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/faq/faq-show.json
     *
     * @param \App\Models\Faq $faq
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Faq $faq)
    {
        return new FaqsResource($faq);
    }

    /**
     * Create a new Faq.
     *
     * This endpoint lets you careate new Faq
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
        return new FaqsResource($this->repository->create($request->all()));
    }

    /**
     * Update Faq.
     *
     * This endpoint allows you to update existing Faq with new data.
     * The Faq to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Faq.
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
        $validation = $this->validateFaq($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($faq, $request->all());

        $faq = Faq::findOrfail($faq->id);

        return new FaqsResource($faq);
    }

    /**
     * Delete Faq.
     *
     * This endpoint allows you to delete a Faq.
     * The Faq to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Faq.
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/faq/faq-destroy.json
     *
     * @param \App\Models\Faq $faq
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Faq $faq)
    {
        $this->repository->delete($faq);

        return $this->respond([
            'message' => __('alerts.backend.faqs.deleted'),
        ]);
    }
}
