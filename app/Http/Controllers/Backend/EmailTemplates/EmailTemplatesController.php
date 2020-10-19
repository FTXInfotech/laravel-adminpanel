<?php

namespace App\Http\Controllers\Backend\EmailTemplates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EmailTemplates\CreateEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\DeleteEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\StoreEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplatesRequest;
use App\Http\Responses\Backend\EmailTemplates\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\EmailTemplate;
use App\Repositories\Backend\EmailTemplatesRepository;
use Illuminate\Support\Facades\View;

class EmailTemplatesController extends Controller
{
    /**
     * @var \App\Repositories\Backend\EmailTemplatesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\EmailTemplatesRepository $emailTemplate
     */
    public function __construct(EmailTemplatesRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['email-templates']);
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
        $this->repository->create($request->except('token'));

        return new RedirectResponse(route('admin.email-templates.index'), ['flash_success' => __('alerts.backend.email-templates.created')]);
    }

    /**
     * @param \App\Models\EmailTemplate $emailTemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest $request
     *
     * @return \App\Http\Responses\Backend\EmailTemplates\EditResponse
     */
    public function edit(EmailTemplate $emailTemplate, ManageEmailTemplatesRequest $request)
    {
        return new EditResponse($emailTemplate);
    }

    /**
     * @param \App\Models\EmailTemplate $emailTemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplatesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(EmailTemplate $emailTemplate, UpdateEmailTemplatesRequest $request)
    {
        $this->repository->update($emailTemplate, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.email-templates.index'), ['flash_success' => __('alerts.backend.email-templates.updated')]);
    }

    /**
     * @param \App\Models\EmailTemplate $emailTemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\DeleteEmailTemplatesRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(EmailTemplate $emailTemplate, DeleteEmailTemplatesRequest $request)
    {
        $this->repository->delete($emailTemplate);

        return new RedirectResponse(route('admin.email-templates.index'), ['flash_success' => __('alerts.backend.email-templates.deleted')]);
    }
}
