<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\FaqsResource;
use App\Models\Faqs\Faq;
use App\Repositories\Backend\Faqs\FaqsRepository;
use Illuminate\Http\Request;
use Validator;

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
     * Return the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;

        return FaqsResource::collection(
            $this->repository->getForDataTable()->paginate($limit)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return new FaqsResource($faq);
    }

    /**
     * Creates the Resource for Faq.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validatingRequest($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->create($request->all());

        return new FaqsResource(Faq::orderBy('created_at', 'desc')->first());
    }

    /**
     * @param Faq              $faq
     * @param UpdateFaqRequest $request
     *
     * @return mixed
     */
    public function update(Request $request, Faq $faq)
    {
        $validation = $this->validatingRequest($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($faq, $request->all());

        $faq = Faq::findOrfail($faq->id);

        return new FaqsResource($faq);
    }

    public function validatingRequest(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'question' => 'required|max:191',
            'answer'   => 'required',
        ]);

        return $validation;
    }

    /**
     * @param Faq              $faq
     * @param DeleteFaqRequest $request
     *
     * @return mixed
     */
    public function destroy(Faq $faq, Request $request)
    {
        $this->repository->delete($faq);

        return ['message'=>'success'];
    }
}
