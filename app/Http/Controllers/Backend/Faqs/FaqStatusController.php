<?php

namespace App\Http\Controllers\Backend\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Faqs\EditFaqsRequest;
use App\Models\Faqs\Faq;
use App\Repositories\Backend\Faqs\FaqsRepository;

class FaqStatusController extends Controller
{
    protected $faq;

    /**
     * @param \App\Repositories\Backend\Faqs\FaqsRepository $faq
     */
    public function __construct(FaqsRepository $faq)
    {
        $this->faq = $faq;
    }

    /**
     * @param \App\Models\Faqs\Faq $Faq
     * @param $status
     * @param \App\Http\Requests\Backend\Faqs\ManageFaqsRequest $request
     *
     * @return mixed
     */
    public function store(Faq $faq, $status, EditFaqsRequest $request)
    {
        $this->faq->mark($faq, $status);

        return redirect()
            ->route('admin.faqs.index')
            ->with('flash_success', trans('alerts.backend.faqs.updated'));
    }
}
