<?php

namespace App\Http\Controllers\Backend\EmailTemplates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EmailTemplates\CreateEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\DeleteEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\StoreEmailTemplatesRequest;
use App\Http\Responses\ViewResponse;
use App\Repositories\Backend\EmailTemplates\EmailTemplatesRepository;
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
     * @param \App\Repositories\Backend\EmailTemplates\EmailTemplatesRepository $emailTemplate
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
        return new ViewResponse('backend.email-templates.index');
    }

    /**
     * @param \App\Http\Requests\Backend\EmailTemplates\CreateEmailTemplatesRequest
     *
     * @return ViewResponse
     */
    public function create(CreateEmailTemplatesRequest $request)
    {
        return new ViewResponse('backend.email-templates.create');
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
     * @param \App\Models\EmailTemplates\EmailTemplate                              $emailTemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest $request
     *
     * @return \App\Http\Responses\Backend\EmailTemplates\EditResponse
     */
    public function edit(EmailTemplate $emailTemplate, ManageEmailTemplatesRequest $request)
    {
        return new EditResponse($emailTemplate);
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate                                  $emailTemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplatesRequest     $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(EmailTemplate $emailTemplate, UpdateEmailTemplatesRequest $request)
    {
        $this->emailTemplate->update($emailTemplate, $request->all());

        return new RedirectResponse(route('admin.email-templates.index'), ['flash_success' => trans('alerts.backend.email-templates.updated')]);
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate                              $emailTemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\DeleteEmailTemplatesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(EmailTemplate $emailTemplate, DeleteEmailTemplatesRequest $request)
    {
        $this->emailTemplate->delete($emailTemplate);

        return new RedirectResponse(route('admin.email-templates.index'), ['flash_success' => trans('alerts.backend.email-templates.deleted')]);
    }
}
