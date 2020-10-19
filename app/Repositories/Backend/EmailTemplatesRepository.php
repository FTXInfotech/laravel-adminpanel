<?php

namespace App\Repositories\Backend;

use App\Events\Backend\EmailTemplates\EmailTemplateCreated;
use App\Events\Backend\EmailTemplates\EmailTemplateDeleted;
use App\Events\Backend\EmailTemplates\EmailTemplateUpdated;
use App\Exceptions\GeneralException;
use App\Models\EmailTemplate;
use App\Repositories\BaseRepository;
use Str;

class EmailTemplatesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = EmailTemplate::class;

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'email_templates.created_by')
            ->select([
                'email_templates.id',
                'email_templates.title',
                'email_templates.status',
                'email_templates.created_by',
                'email_templates.created_at',
                'users.first_name as user_name',
            ])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'email_templates.created_by')
            ->select([
                'email_templates.id',
                'email_templates.title',
                'email_templates.status',
                'users.first_name as created_by',
                'email_templates.created_at',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        $input['slug'] = Str::slug($input['title']);
        $input['created_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($emailTemplate = EmailTemplate::create($input)) {
            event(new EmailTemplateCreated($emailTemplate));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.create_error'));
    }

    /**
     * @param \App\Models\EmailTemplate $emailTemplate
     * @param array $input
     */
    public function update(EmailTemplate $emailTemplate, array $input)
    {
        $input['updated_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($emailTemplate->update($input)) {
            event(new EmailTemplateUpdated($emailTemplate));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.update_error'));
    }

    /**
     * @param \App\Models\EmailTemplate $emailTemplate
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(EmailTemplate $emailTemplate)
    {
        if ($emailTemplate->delete()) {
            event(new EmailTemplateDeleted($emailTemplate));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.email-templates.delete_error'));
    }
}
