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
use App\Models\Faq;
use App\Repositories\Backend\FaqsRepository;
use Illuminate\Support\Facades\View;

class FaqsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\FaqsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\FaqsRepository $faq
     */
    public function __construct(FaqsRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['faqs']);
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
        $this->repository->create($request->except('_token'));

        return new RedirectResponse(route('admin.faqs.index'), ['flash_success' => __('alerts.backend.faqs.created')]);
    }

    /**
     * @param \App\Models\Faq $faq
     * @param \App\Http\Requests\Backend\Faqs\ManagePageRequest $request
     *
     * @return ViewResponse
     */
    public function edit(Faq $faq, ManageFaqsRequest $request)
    {
        return new ViewResponse('backend.faqs.edit', ['faq' => $faq]);
    }

    /**
     * @param \App\Models\Faq $faq
     * @param \App\Http\Requests\Backend\Faqs\UpdateFaqsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Faq $faq, UpdateFaqsRequest $request)
    {
        $this->repository->update($faq, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.faqs.index'), ['flash_success' => __('alerts.backend.faqs.updated')]);
    }

    /**
     * @param \App\Models\Faq $faq
     * @param \App\Http\Requests\Backend\Pages\DeleteFaqRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Faq $faq, DeleteFaqsRequest $request)
    {
        $this->repository->delete($faq);

        return new RedirectResponse(route('admin.faqs.index'), ['flash_success' => __('alerts.backend.faqs.deleted')]);
    }
}
