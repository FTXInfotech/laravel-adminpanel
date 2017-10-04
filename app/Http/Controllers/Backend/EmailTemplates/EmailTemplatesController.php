<?php

namespace App\Http\Controllers\Backend\EmailTemplates;

use App\Models\EmailTemplates\EmailTemplate;
use App\Models\EmailTemplateTypes\EmailTemplateType;
use App\Models\EmailTemplatePlaceholders\EmailTemplatePlaceholder;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\EmailTemplates\EmailTemplatesRepository;
use App\Http\Requests\Backend\EmailTemplates\ManageEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\EditEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\DeleteEmailTemplatesRequest;
use App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplatesRequest;

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
     * Setting the EmailTemplatesRepository instance to class variable
     *
     * @param EmailTemplatesRepository $emailtemplates
     */
    public function __construct(EmailTemplatesRepository $emailtemplates)
    {
        $this->emailtemplates = $emailtemplates;
    }

    /**
     * Use to load index view of EmailTmplates
     *
     * @param ManageEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function index(ManageEmailTemplatesRequest $request)
    {
        return view('backend.emailtemplates.index');
    }

    /**
     * Use to load edit form of Emailtemplate
     *
     * @param EmailTemplate          $emailtemplate
     * @param EditEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function edit(EmailTemplate $emailtemplate, EditEmailTemplatesRequest
        $request)
    {
        $emailtemplateTypes         = EmailTemplateType::pluck('name', 'id');
        $emailtemplatePlaceholders  = EmailTemplatePlaceholder::pluck('name', 'id');
        return view('backend.emailtemplates.edit')
            ->withEmailtemplate($emailtemplate)
            ->withEmailtemplatetypes($emailtemplateTypes)
            ->withEmailtemplateplaceholders($emailtemplatePlaceholders);
        }

    /**
     * Use to update an Emailtemplate
     *
     * @param EmailTemplate              $emailtemplate
     * @param UpdateEmailTemplatesRequest $request
     *
     * @return mixed
     */
    public function update(EmailTemplate $emailtemplate, UpdateEmailTemplatesRequest
        $request)
    {
        $this->emailtemplates->update($emailtemplate, $request->all());
        return redirect()->route('admin.emailtemplates.index')
            ->withFlashSuccess(trans('alerts.backend.emailtemplates.updated'));
    }

    /**
     * Use to delete an Emailtemplate
     *
     * @param EmailTemplate              $emailtemplate
     * @param DeleteEmailTemplatesRequest $request
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
