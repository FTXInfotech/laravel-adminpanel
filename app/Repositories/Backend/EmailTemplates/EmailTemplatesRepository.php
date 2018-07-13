<?php

namespace App\Repositories\Backend\EmailTemplates;

use App\Events\Backend\EmailTemplates\EmailTemplateDeleted;
use App\Events\Backend\EmailTemplates\EmailTemplateUpdated;
use App\Exceptions\GeneralException;
use App\Models\EmailTemplates\EmailTemplate;
use App\Repositories\BaseRepository;

/**
 * Class EmailTemplatesRepository.
 */
class EmailTemplatesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = EmailTemplate::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('module.email_templates.table').'.id',
                config('module.email_templates.table').'.title',
                config('module.email_templates.table').'.subject',
                config('module.email_templates.table').'.status',
                config('module.email_templates.table').'.created_at',
                config('module.email_templates.table').'.updated_at',
            ]);
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate $emailtemplate
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
    public function update(EmailTemplate $emailtemplate, array $input)
    {
        $input['status'] = isset($input['is_active']) ? 1 : 0;
        unset($input['is_active']);
        $input['updated_by'] = access()->user()->id;

        if ($emailtemplate->update($input)) {
            event(new EmailTemplateUpdated($emailtemplate));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.emailtemplates.update_error'));
    }

    /**
     * @param \App\Models\EmailTemplates\EmailTemplate $emailtemplate
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(EmailTemplate $emailtemplate)
    {
        if ($emailtemplate->delete()) {
            event(new EmailTemplateDeleted($emailtemplate));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.emailtemplates.delete_error'));
    }
}
