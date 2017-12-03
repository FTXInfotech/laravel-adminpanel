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
    /**
     * @var EmailTemplatesRepository
     */
    protected $emailtemplates;

    /**
     * @param \App\Repositories\Backend\EmailTemplates\EmailTemplatesRepository $emailtemplates
     */
    public function __construct(EmailTemplatesRepository $emailtemplates)
    {
        $this->emailtemplates = $emailtemplates;
    }

    /**
     * @param \App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageEmailTemplatesRequest $request)
    {
        return Datatables::of($this->emailtemplates->getForDataTable())
            ->escapeColumns(['title'])
            ->addColumn('status', function ($emailtemplates) {
                return $emailtemplates->status_label;
            })
            ->addColumn('created_at', function ($emailtemplates) {
                return Carbon::parse($emailtemplates->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($emailtemplates) {
                return Carbon::parse($emailtemplates->updated_at)->toDateString();
            })
            ->addColumn('actions', function ($emailtemplates) {
                return $emailtemplates->action_buttons;
            })
            ->make(true);
    }
}
