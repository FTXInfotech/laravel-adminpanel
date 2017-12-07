<?php

namespace App\Http\Controllers\Backend\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Faqs\CreateFaqsRequest;
use App\Http\Requests\Backend\Faqs\DeleteFaqsRequest;
use App\Http\Requests\Backend\Faqs\EditFaqsRequest;
use App\Http\Requests\Backend\Faqs\ManageFaqsRequest;
use App\Http\Requests\Backend\Faqs\StoreFaqsRequest;
use App\Http\Requests\Backend\Faqs\UpdateFaqsRequest;
use App\Models\Faqs\Faq;
use App\Repositories\Backend\Faqs\FaqsRepository;

class FaqsController extends Controller
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
     * Display a listing of the resource.
     * @param \App\Http\Requests\Backend\Faqs\ManageFaqsRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(ManageFaqsRequest $request)
    {
        return view('backend.faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     * @param \App\Http\Requests\Backend\Faqs\CreateFaqsRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(CreateFaqsRequest $request)
    {
        return view('backend.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\Backend\Faqs\StoreFaqsRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqsRequest $request)
    {
        $input = $request->all();

        $this->faq->create($input);

        return redirect()
            ->route('admin.faqs.index')
            ->with('flash_success', trans('alerts.backend.faqs.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Faqs\Faq $faq
     * @param \App\Http\Requests\Backend\Faqs\EditFaqsRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq, EditFaqsRequest $request)
    {
        return view('backend.faqs.edit')
            ->with('faq', $faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Backend\Faqs\UpdateFaqsRequest $request
     * @param \App\Models\Faqs\Faq     $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqsRequest $request, Faq $faq)
    {
        $input = $request->all();

        $this->faq->update($faq, $input);

        return redirect()
            ->route('admin.faqs.index')
            ->with('flash_success', trans('alerts.backend.faqs.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Faqs\Faq $faq
     * @param \App\Http\Requests\Backend\Faqs\DeleteFaqsRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq, DeleteFaqsRequest $request)
    {
        $this->faq->delete($faq);

        return redirect()
            ->route('admin.faqs.index')
            ->with('flash_success', trans('alerts.backend.faqs.deleted'));
    }
}
