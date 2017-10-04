<?php

namespace App\Repositories\Backend\Faqs;

use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use App\Models\Faqs\Faq;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaqsRepository.
 */
class FaqsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Faq::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.faqs_table').'.id',
                config('access.faqs_table').'.question',
                config('access.faqs_table').'.answer',
                config('access.faqs_table').'.status',
                config('access.faqs_table').'.created_at',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        $faq = self::MODEL;
        $faq = new $faq();
        $faq->question = $input['question'];
        $faq->answer = $input['answer'];
        $faq->status = isset($input['status']) ? $input['status'] : 0;

        //If faq saved successfully, then return true
        if ($faq->save()) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.faqs.create_error'));
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
     
    public function update(Model $faq, array $input)
    {
        $faq->question = $input['question'];
        $faq->answer = $input['answer'];
        $faq->status = isset($input['status']) ? $input['status'] : 0;

        //If faq updated successfully
        if ($faq->save()) {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.faqs.update_error'));
    }

    /**
     * @param Model $blog
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $faq)
    {
        if ($faq->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.faqs.delete_error'));
    }

    /**
     * @param Model $faq
     * @param $status
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function mark(Model $faq, $status)
    {
        $faq->status = $status;

        if ($faq->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.faqs.mark_error'));
    }
}