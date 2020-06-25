<?php

namespace App\Http\Controllers\Backend\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Faqs\ManageFaqsRequest;
use App\Repositories\Backend\FaqsRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class FaqsTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\FaqsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\FaqsRepository $faqs
     */
    public function __construct(FaqsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Faqs\ManageFaqsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageFaqsRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['question'])
            ->filterColumn('status', function ($query, $keyword) {
                if (in_array(strtolower($keyword), ['active', 'inactive'])) {
                    $query->where('faqs.status', (strtolower($keyword) == 'active') ? 1 : 0);
                }
            })
            ->editColumn('status', function ($faqs) {
                return $faqs->status_label;
            })
            ->editColumn('created_at', function ($faqs) {
                return Carbon::parse($faqs->created_at)->toDateString();
            })
            ->addColumn('actions', function ($faqs) {
                return $faqs->action_buttons;
            })
            ->make(true);
    }
}
