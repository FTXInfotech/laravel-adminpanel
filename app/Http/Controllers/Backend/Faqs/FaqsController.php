<?php

namespace App\Http\Controllers\Backend\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Faqs\CreateFaqsRequest;
use App\Http\Requests\Backend\Faqs\DeleteFaqsRequest;
use App\Http\Requests\Backend\Faqs\ManageFaqsRequest;
use App\Http\Requests\Backend\Faqs\StoreFaqsRequest;
use App\Http\Requests\Backend\Faqs\UpdateFaqsRequest;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Faqs\Faq;
use App\Repositories\Backend\Faqs\FaqsRepository;

class FaqsController extends Controller
{
    /**
     * @var FaqsRepository
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
     * @param \App\Http\Requests\Backend\Faqs\ManageFaqsRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageFaqsRequest $request)
    {
        return new ViewResponse('backend.faqs.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Faqs\CreateFaqsRequest $request
     *
     * @return ViewResponse
     */
    public function create(CreateFaqsRequest $request)
    {
        return new ViewResponse('backend.faqs.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Faqs\StoreFaqsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreFaqsRequest $request)
    {
        $this->faq->create($request->except('_token'));

        return new RedirectResponse(route('admin.faqs.index'), ['flash_success' => trans('alerts.backend.faqs.created')]);
    }

    /**
     * @param \App\Models\Faqs\Faq                              $faq
     * @param \App\Http\Requests\Backend\Faqs\ManagePageRequest $request
     *
     * @return ViewResponse
     */
    public function edit(Faq $faq, ManageFaqsRequest $request)
    {
        return new ViewResponse('backend.faqs.edit', ['faq' => $faq]);
    }

    /**
     * @param \App\Models\Faqs\Faq                              $faq
     * @param \App\Http\Requests\Backend\Faqs\UpdateFaqsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Faq $faq, UpdateFaqsRequest $request)
    {
        $input = $request->all();

        $this->faq->update($faq, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.faqs.index'), ['flash_success' => trans('alerts.backend.faqs.updated')]);
    }

    /**
     * @param \App\Models\Faqs\Faq                              $faq
     * @param \App\Http\Requests\Backend\Pages\DeleteFaqRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Faq $faq, DeleteFaqsRequest $request)
    {
        $this->faq->delete($faq);

        return new RedirectResponse(route('admin.faqs.index'), ['flash_success' => trans('alerts.backend.faqs.deleted')]);
    }
}
