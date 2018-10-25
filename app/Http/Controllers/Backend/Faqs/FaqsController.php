<?php

namespace App\Http\Controllers\Backend\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Faqs\CreateFaqsRequest;
use App\Http\Requests\Backend\Faqs\DeleteFaqsRequest;
use App\Http\Requests\Backend\Faqs\EditFaqsRequest;
use App\Http\Requests\Backend\Faqs\ManageFaqsRequest;
use App\Http\Requests\Backend\Faqs\StoreFaqsRequest;
use App\Http\Requests\Backend\Faqs\UpdateFaqsRequest;
use App\Http\Responses\Backend\Faq\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Faqs\Faq;
use App\Repositories\Backend\Faqs\FaqsRepository;

class FaqsController extends Controller
{
    /**
     * Faq Repository.
     *
     * @var \App\Repositories\Backend\Faqs\FaqsRepository
     */
    protected $faq;

    /**
     * @param \App\Repositories\Backend\Faqs\FaqsRepository $faq
     */
    public function __construct(FaqsRepository $faq)
    {
        $this->faq = $faq;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\Backend\Faqs\ManageFaqsRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageFaqsRequest $request)
    {
        return new ViewResponse('backend.faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Http\Requests\Backend\Faqs\CreateFaqsRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateFaqsRequest $request)
    {
        return new ViewResponse('backend.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Backend\Faqs\StoreFaqsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreFaqsRequest $request)
    {
        $this->faq->create($request->all());

        return new RedirectResponse(route('admin.faqs.index'), ['flash_success' => trans('alerts.backend.faqs.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Faqs\Faq                            $faq
     * @param \App\Http\Requests\Backend\Faqs\EditFaqsRequest $request
     *
     * @return \App\Http\Responses\Backend\Faq\EditResponse
     */
    public function edit(Faq $faq, EditFaqsRequest $request)
    {
        return new EditResponse($faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Backend\Faqs\UpdateFaqsRequest $request
     * @param \App\Models\Faqs\Faq                              $id
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(UpdateFaqsRequest $request, Faq $faq)
    {
        $this->faq->update($faq, $request->all());

        return new RedirectResponse(route('admin.faqs.index'), ['flash_success' => trans('alerts.backend.faqs.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Faqs\Faq                              $faq
     * @param \App\Http\Requests\Backend\Faqs\DeleteFaqsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Faq $faq, DeleteFaqsRequest $request)
    {
        $this->faq->delete($faq);

        return new RedirectResponse(route('admin.faqs.index'), ['flash_success' => trans('alerts.backend.faqs.deleted')]);
    }
}
