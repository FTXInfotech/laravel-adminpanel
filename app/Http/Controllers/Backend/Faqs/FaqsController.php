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
    /**
     * @var FaqsRepository
     */
    protected $faqs;

    /**
     * @param FaqsRepository $faqs
     */
    public function __construct(FaqsRepository $faqs)
    {
        $this->faqs = $faqs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageFaqsRequest $request)
    {
        //Status array
        $status = [1 => 'Active', 0 => 'Inactive'];

        return view('backend.faqs.index')->withStatus($status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateFaqsRequest $request)
    {
        return view('backend.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqsRequest $request)
    {
        $input = $request->all();

        $this->faqs->create($input);

        return redirect()->route('admin.faqs.index')->withFlashSuccess(trans('alerts.backend.faqs.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq, EditFaqsRequest $request)
    {
        return view('backend.faqs.edit')->withItem($faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqsRequest $request, Faq $faq)
    {
        $input = $request->all();

        $this->faqs->update($faq, $input);

        return redirect()->route('admin.faqs.index')->withFlashSuccess(trans('alerts.backend.faqs.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq, DeleteFaqsRequest $request)
    {
        $this->faqs->delete($faq);

        return redirect()->route('admin.faqs.index')->withFlashSuccess(trans('alerts.backend.faqs.deleted'));
    }

    /**
     * @param Faq $Faq
     * @param $status
     * @param ManageFaqRequest $request
     *
     * @return mixed
     */
    public function mark($id, $status, EditFaqsRequest $request)
    {
        $faq = Faq::find($id);
        $this->faqs->mark($faq, $status);

        return redirect()->route('admin.faqs.index')->withFlashSuccess(trans('alerts.backend.faqs.updated'));
    }
}
