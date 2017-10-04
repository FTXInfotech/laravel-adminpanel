<?php

namespace App\Repositories\Backend\EmailTemplates;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\EmailTemplates\EmailTemplate;
use Illuminate\Database\Eloquent\Model;
use App\Events\Backend\EmailTemplates\EmailTemplateDeleted;
use App\Events\Backend\EmailTemplates\EmailTemplateUpdated;
use DB;

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
                config('access.email_templates_table').'.id',
                config('access.email_templates_table').'.title',
                config('access.email_templates_table').'.subject',
                config('access.email_templates_table').'.status',
                config('access.email_templates_table').'.created_at',
                config('access.email_templates_table').'.updated_at',
            ]);
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
     
    public function update(Model $emailtemplate, array $input)
    {
        $emailtemplate->title = $input['title'];
        $emailtemplate->body = $input['body'];
        $emailtemplate->type_id = $input['type_id'];
        $emailtemplate->subject = $input['subject'];
        $emailtemplate->status = (isset($input['is_active']) && $input['is_active'] == 1) ? 1 : 0;
        $emailtemplate->updated_by = access()->user()->id;

        DB::transaction(function () use ($emailtemplate, $input) {
        	if ($emailtemplate->save()) {
                event(new EmailTemplateUpdated($emailtemplate));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.emailtemplates.update_error'));
        });
    }

    /**
     * @param Model $emailtemplate
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $emailtemplate)
    {
        DB::transaction(function () use ($emailtemplate) {

            if ($emailtemplate->delete()) {
                event(new EmailTemplateDeleted($emailtemplate));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.emailtemplates.delete_error'));
        });
    }
}
