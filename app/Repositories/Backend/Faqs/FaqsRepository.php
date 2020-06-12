<?php

namespace App\Repositories\Backend\Faqs;

use App\Events\Backend\Faqs\FaqDeleted;
use App\Events\Backend\Faqs\FaqCreated;
use App\Events\Backend\Faqs\FaqUpdated;
use App\Exceptions\GeneralException;
use App\Models\Faqs\Faq;
use App\Repositories\BaseRepository;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class FaqsRepository.
 */
class FaqsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Faq::class;

    protected $faq;

    public function __construct(Faq $faq)
    {
        $this->model = $faq;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model->query()
            ->select([
                'faqs.id',
                'faqs.question',
                'faqs.answer',
                'faqs.created_at',
                'faqs.status'
            ])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->query()
            ->select([
                'faqs.id',
                'faqs.question',
                'faqs.answer',
                'faqs.created_at',
                'faqs.status'
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
        return DB::transaction(function () use ($input) {
            $input['created_by'] = auth()->user()->id;

            if ($faq = Faq::create($input)) {
                
                event(new FaqCreated($faq));

                return $faq;
            }

            throw new GeneralException(trans('exceptions.backend.access.faqs.create_error'));
        });
    }

    /**
     * Update Faq.
     *
     * @param \App\Models\Faqs\Faq $page
     * @param array                  $input
     */
    public function update(Faq $faq, array $input)
    {
        $input['updated_by'] = auth()->user()->id;

        return DB::transaction(function () use ($faq, $input) {
            if ($faq->update($input)) {

                event(new FaqUpdated($faq));

                return $faq;
            }

            throw new GeneralException(
                trans('exceptions.backend.access.faqs.update_error')
            );
        });
    }

    /**
     * @param \App\Models\Faqs\Faq $faq
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Faq $faq)
    {
        DB::transaction(function () use ($faq) {
            if ($faq->delete()) {
                
                event(new FaqDeleted($faq));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.faqs.delete_error'));
        });
    }
}
