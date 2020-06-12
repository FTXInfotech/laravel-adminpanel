<?php

namespace App\Repositories\Backend\Pages;

use App\Events\Backend\Pages\PageCreated;
use App\Events\Backend\Pages\PageDeleted;
use App\Events\Backend\Pages\PageUpdated;
use App\Exceptions\GeneralException;
use App\Models\Pages\Page;
use App\Repositories\BaseRepository;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class PagesRepository.
 */
class PagesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Page::class;

    protected $page;

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct(Page $page)
    {
        $this->model = $page;
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'page'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
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
            ->leftjoin('users', 'users.id', '=', 'pages.created_by')
            ->select([
                'pages.id',
                'pages.title',
                'pages.status',
                'pages.created_by',
                'pages.created_at',
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
        return $this->model->query()
            ->leftjoin('users', 'users.id', '=', 'pages.created_by')
            ->select([
                'pages.id',
                'pages.title',
                'pages.status',
                'pages.created_by',
                'pages.created_at',
                'users.first_name as user_name',
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
            $input['page_slug'] = Str::slug($input['title']);
            $input['created_by'] = auth()->user()->id;

            if ($page = Page::create($input)) {
                
                event(new PageCreated($page));

                return $page;
            }

            throw new GeneralException(trans('exceptions.backend.access.pages.create_error'));
        });
    }

    /**
     * Update Page.
     *
     * @param \App\Models\Pages\Page $page
     * @param array                  $input
     */
    public function update(Page $page, array $input)
    {
        $input['page_slug'] = Str::slug($input['title']);
        $input['updated_by'] = auth()->user()->id;

        return DB::transaction(function () use ($page, $input) {
            if ($page->update($input)) {

                event(new PageUpdated($page));

                return $page;
            }

            throw new GeneralException(
                trans('exceptions.backend.access.pages.update_error')
            );
        });
    }

    /**
     * @param \App\Models\Pages\Page $page
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Page $page)
    {
        DB::transaction(function () use ($page) {
            if ($page->delete()) {
                
                event(new PageDeleted($page));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.pages.delete_error'));
        });
    }
}
