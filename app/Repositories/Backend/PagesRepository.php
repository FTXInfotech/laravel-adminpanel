<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Pages\PageCreated;
use App\Events\Backend\Pages\PageDeleted;
use App\Events\Backend\Pages\PageUpdated;
use App\Exceptions\GeneralException;
use App\Models\Page;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class PagesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Page::class;

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->query()
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
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'pages.created_by')
            ->select([
                'pages.id',
                'pages.title',
                'pages.status',
                'users.first_name as created_by',
                'pages.created_at',
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
        if ($this->query()->where('title', $input['title'])->first()) {
            throw new GeneralException(__('exceptions.backend.pages.already_exists'));
        }

        $input['page_slug'] = Str::slug($input['title']);
        $input['created_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($page = Page::create($input)) {

            event(new PageCreated($page));
            
            return $page;
        }

        throw new GeneralException(__('exceptions.backend.pages.create_error'));
    }

    /**
     * Update Page.
     *
     * @param \App\Models\Page $page
     * @param array $input
     */
    public function update(Page $page, array $input)
    {
        if ($this->query()->where('title', $input['title'])->where('id', '!=', $page->id)->first()) {
            throw new GeneralException(__('exceptions.backend.pages.already_exists'));
        }

        $input['page_slug'] = Str::slug($input['title']);
        $input['updated_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($page->update($input)) {

            event(new PageUpdated($page));
            
            return $page;
        }

        throw new GeneralException(
            __('exceptions.backend.pages.update_error')
        );
    }

    /**
     * @param \App\Models\Page $page
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Page $page)
    {
        if ($page->delete()) {

            event(new PageDeleted($page));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.pages.delete_error'));
    }
}
