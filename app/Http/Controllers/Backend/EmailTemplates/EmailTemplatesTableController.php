<?php

namespace App\Http\Controllers\Backend\EmailTemplates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest;
use App\Repositories\Backend\EmailTemplatesRepository;
use Yajra\DataTables\Facades\DataTables;

class EmailTemplatesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\EmailTemplatesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\EmailTemplatesRepository $repository
     */
    public function __construct(EmailTemplatesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageEmailTemplatesRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->filterColumn('status', function ($query, $keyword) {
                if (in_array(strtolower($keyword), ['active', 'inactive'])) {
                    $query->where('email_templates.status', (strtolower($keyword) == 'active') ? 1 : 0);
                }
            })
            ->filterColumn('created_by', function ($query, $keyword) {
                $query->whereRaw('users.first_name like ?', ["%{$keyword}%"]);
            })
            ->editColumn('status', function ($emailTemplate) {
                return $emailTemplate->status_label;
            })
            ->editColumn('created_at', function ($emailTemplate) {
                return $emailTemplate->created_at->toDateString();
            })
            ->addColumn('actions', function ($emailTemplate) {
                return $emailTemplate->action_buttons;
            })
            ->escapeColumns(['name'])

            ->make(true);
    }
}
