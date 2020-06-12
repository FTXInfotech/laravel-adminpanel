<?php

namespace App\Http\Controllers\Backend\EmailTemplates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest;
use App\Repositories\Backend\EmailTemplates\EmailTemplatesRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class EmailTemplatesTableController.
 */
class EmailTemplatesTableController extends Controller
{
    protected $emailTemplate;

    /**
     * @param \App\Repositories\Backend\EmailTemplates\EmailTemplatesRepository $cmspages
     */
    public function __construct(EmailTemplatesRepository $emailTemplate)
    {
        $this->emailTemplate = $emailTemplate;
    }

    /**P
     * @param \App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageEmailTemplatesRequest $request)
    {
        return Datatables::of($this->emailTemplate->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($emailTemplate) {
                return $emailTemplate->status_label;
            })
            ->addColumn('created_by', function ($emailTemplate) {
                return $emailTemplate->user_name;
            })
            ->addColumn('created_at', function ($emailTemplate) {
                return Carbon::parse($emailTemplate->created_at)->toDateString();
            })
            ->addColumn('actions', function ($emailTemplate) {
                return $emailTemplate->action_buttons;
            })
            ->make(true);
    }
}
