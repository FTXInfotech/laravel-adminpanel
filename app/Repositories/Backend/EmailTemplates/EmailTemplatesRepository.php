<?php

namespace App\Repositories\Backend\EmailTemplates;

use App\Events\Backend\EmailTemplates\EmailTemplateCreated;
use App\Events\Backend\EmailTemplates\EmailTemplateDeleted;
use App\Events\Backend\EmailTemplates\EmailTemplateUpdated;
use App\Exceptions\GeneralException;
use App\Models\EmailTemplates\EmailTemplate;
use App\Repositories\BaseRepository;
use DB;
use Str;

/**
 * Class EmailTemplatesRepository.
 */
class EmailTemplatesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = EmailTemplate::class;

    protected $emailTemplate;

    protected $upload_path;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct(EmailTemplate $emailTemplate)
    {
        $this->model = $emailTemplate;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->model->query()
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
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        DB::transaction(function () use ($input) {
            $input['slug'] = Str::slug($input['slug']);
            $input['created_by'] = auth()->user()->id;

            if ($emailTemplate = EmailTemplate::create($input)) {
                
                event(new EmailTemplateCreated($emailTemplate));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.email-templates.create_error'));
        });
    }

    /**
     * Update Page.
     *
     * @param \App\Models\EmailTemplates\Page $page
     * @param array                  $input
     */
    public function update(EmailTemplate $emailTemplate, array $input)
    {
        $input['updated_by'] = auth()->user()->id;

        DB::transaction(function () use ($emailTemplate, $input) {
            if ($emailTemplate->update($input)) {

                event(new EmailTemplateUpdated($emailTemplate));

                return true;
            }

            throw new GeneralException(
                trans('exceptions.backend.access.EmailTemplates.update_error')
            );
        });
    }

    /**
     * @param \App\Models\EmailTemplates\Page $page
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(EmailTemplate $emailTemplate)
    {
        DB::transaction(function () use ($emailTemplate) {
            if ($emailTemplate->delete()) {
                
                event(new EmailTemplateDeleted($emailTemplate));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.email-templates.delete_error'));
        });
    }
}
