<?php

namespace App\Http\Controllers\Backend\EmailTemplates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EmailTemplates\CreateEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\DeleteEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\StoreEmailTemplatesRequest;
use App\Http\Responses\Backend\EmailTemplates\IndexResponse;
use App\Http\Responses\ViewResponse;
use App\Repositories\Backend\EmailTemplates\EmailTemplatesRepository;
use Illuminate\Http\Request;
use App\Models\EmailTemplates\EmailTemplate;
use App\Http\Responses\Backend\EmailTemplates\EditResponse;
use App\Http\Responses\RedirectResponse;

class EmailTemplatesController extends Controller
{
    /**
     * @var EmailTemplatesRepository
     */
    protected $emailTemplate;
    
    /**
     * @param \App\Repositories\Backend\EmailTemplates\EmailTemplatesRepository $tag
     */
    public function __construct(EmailTemplatesRepository $emailTemplate)
    {
        $this->emailTemplate = $emailTemplate;
    }

    /**
     * @param \App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageEmailTemplatesRequest $request)
    {
        return new IndexResponse($this->emailTemplate->getActivePaginated(25, 'created_at', 'desc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateEmailTemplatesRequest $request)
    {
        return view('backend.email-templates.create');
    }

    /**
     * @param \App\Http\Requests\Backend\EmailTemplates\StoreEmailTemplatesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreEmailTemplatesRequest $request)
    {
        $this->emailTemplate->create($request->except('token'));

        return new RedirectResponse(route('admin.email-templates.index'), ['flash_success' => trans('alerts.backend.email-templates.created')]);
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate             $EmailTemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest $request
     *
     * @return \App\Http\Responses\Backend\EmailTemplates\EditResponse
     */
    public function edit(EmailTemplate $emailTemplate, ManageEmailTemplatesRequest $request)
    {
        return new EditResponse($emailTemplate);
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate                               $EmailTemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplatesRequest   $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(EmailTemplate $emailTemplate, UpdateEmailTemplatesRequest $request)
    {
        $this->emailTemplate->update($emailTemplate, $request->all());

        return new RedirectResponse(route('admin.email-templates.index'), ['flash_success' => trans('alerts.backend.email-templates.updated')]);
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate                              $EmailTemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\DeleteEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function destroy(EmailTemplate $emailTemplate, DeleteEmailTemplatesRequest $request)
    {
        $this->emailTemplate->delete($emailTemplate);

        return new RedirectResponse(route('admin.email-templates.index'), ['flash_success' => trans('alerts.backend.email-templates.deleted')]);
    }
}
