<?php

namespace App\Repositories\Backend;

use App\Models\Faq;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Faqs\FaqCreated;
use App\Events\Backend\Faqs\FaqDeleted;
use App\Events\Backend\Faqs\FaqUpdated;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FaqsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Faq::class;

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->query()
            ->select([
                'faqs.id',
                'faqs.question',
                'faqs.answer',
                'faqs.created_at',
                'faqs.status',
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
            ->select([
                'id',
                'question',
                'answer',
                'created_at',
                'status',
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
        $input['created_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($faq = Faq::create($input)) {
            event(new FaqCreated($faq));

            return $faq;
        }

        throw new GeneralException(__('exceptions.backend.faqs.create_error'));
    }

    /**
     * @param \App\Models\Faq $faq
     * @param array $input
     */
    public function update(Faq $faq, array $input)
    {
        $input['updated_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($faq->update($input)) {
            event(new FaqUpdated($faq));

            return $faq;
        }

        throw new GeneralException(__('exceptions.backend.faqs.update_error'));
    }

    /**
     * @param \App\Models\Faq $faq
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Faq $faq)
    {
        if ($faq->delete()) {
            event(new FaqDeleted($faq));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.faqs.delete_error'));
    }
}
