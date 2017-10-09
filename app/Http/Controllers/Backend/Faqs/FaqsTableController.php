<?php

namespace App\Http\Controllers\Backend\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Faqs\ManageFaqsRequest;
use App\Repositories\Backend\Faqs\FaqsRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class FaqsTableController extends Controller
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
     * @param ManageFaqsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageFaqsRequest $request)
    {
        return Datatables::of($this->faqs->getForDataTable())
            ->escapeColumns(['question'])
            ->addColumn('answer', function ($faqs) {
                return $faqs->answer;
            })
            ->addColumn('status', function ($faqs) {
                return $faqs->status_label;
            })
            ->addColumn('updated_at', function ($faqs) {
                return Carbon::parse($faqs->updated_at)->toDateString();
            })
            ->addColumn('actions', function ($faqs) {
                return $faqs->action_buttons;
            })
            ->make(true);
    }
}
