<?php

namespace App\Http\Controllers\Backend\EmailTemplates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EmailTemplates\DeleteEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\EditEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplatesRequest;
use App\Models\EmailTemplatePlaceholders\EmailTemplatePlaceholder;
use App\Models\EmailTemplates\EmailTemplate;
use App\Models\EmailTemplateTypes\EmailTemplateType;
use App\Repositories\Backend\EmailTemplates\EmailTemplatesRepository;

/**
 * Class EmailTemplatesController.
 */
class EmailTemplatesController extends Controller
{
    /**
     * @var EmailTemplatesRepository
     */
    protected $emailtemplates;

    /**
     * __construct.
     *
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
    public function index(ManageEmailTemplatesRequest $request)
    {
        return view('backend.emailtemplates.index');
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate                            $emailtemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\EditEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function edit(EmailTemplate $emailtemplate, EditEmailTemplatesRequest
        $request)
    {
        $emailtemplateTypes = EmailTemplateType::getSelectData();
        $emailtemplatePlaceholders = EmailTemplatePlaceholder::getSelectData();

        return view('backend.emailtemplates.edit')
            ->withEmailtemplate($emailtemplate)
            ->withEmailtemplatetypes($emailtemplateTypes)
            ->withEmailtemplateplaceholders($emailtemplatePlaceholders);
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate                              $emailtemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function update(EmailTemplate $emailtemplate, UpdateEmailTemplatesRequest
        $request)
    {
        $this->emailtemplates->update($emailtemplate, $request->except(['_method', '_token', 'placeholder']));

        return redirect()->route('admin.emailtemplates.index')
            ->withFlashSuccess(trans('alerts.backend.emailtemplates.updated'));
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate                              $emailtemplate
     * @param \App\Http\Requests\Backend\EmailTemplates\DeleteEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function destroy(EmailTemplate $emailtemplate, DeleteEmailTemplatesRequest
        $request)
    {
        $this->emailtemplates->delete($emailtemplate);

        return redirect()->route('admin.emailtemplates.index')
            ->withFlashSuccess(trans('alerts.backend.emailtemplates.deleted'));
    }
}
