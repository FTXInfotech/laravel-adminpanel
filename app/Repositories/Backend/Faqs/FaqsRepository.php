<?php

namespace App\Repositories\Backend\Faqs;

use App\Exceptions\GeneralException;
use App\Models\Faqs\Faq;
use App\Repositories\BaseRepository;

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
                config('module.faqs.table').'.id',
                config('module.faqs.table').'.question',
                config('module.faqs.table').'.answer',
                config('module.faqs.table').'.status',
                config('module.faqs.table').'.created_at',
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
        $input['status'] = isset($input['status']) ? 1 : 0;

        //If faq saved successfully, then return true
        if (Faq::create($input)) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.faqs.create_error'));
    }

    /**
     * @param \App\Models\Faqs\Faq $faq
     * @param array                $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * return bool
     */
    public function update(Faq $faq, array $input)
    {
        $input['status'] = isset($input['status']) ? 1 : 0;

        //If faq updated successfully
        if ($faq->update($input)) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.faqs.update_error'));
    }

    /**
     * @param \App\Models\Faqs\Faq $faq
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function delete(Faq $faq)
    {
        if ($faq->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.faqs.delete_error'));
    }

    /**
     * @param \App\Models\Faqs\Faq $faq
     * @param string               $status
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function mark(Faq $faq, $status)
    {
        $faq->status = $status;

        if ($faq->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.faqs.mark_error'));
    }
}
