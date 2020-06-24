<?php

namespace App\Repositories\Backend;

use App\Models\Page;
use App\Repositories\BaseRepository;
use App\Events\Backend\PageCreated;
use App\Events\Backend\PageUpdated;
use App\Events\Backend\PageDeleted;
use App\Exceptions\GeneralException;
use Illuminate\Support\Str;

class PagesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Page::class;

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
            throw new GeneralException(trans('exceptions.backend.pages.already_exists'));
        }

        $input['page_slug'] = Str::slug($input['title']);
        $input['created_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($page = Page::create($input)) {

            event(new PageCreated($page));

            return $page;
        }

        throw new GeneralException(trans('exceptions.backend.access.pages.create_error'));
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
            throw new GeneralException(trans('exceptions.backend.pages.already_exists'));
        }

        $input['page_slug'] = Str::slug($input['title']);
        $input['updated_by'] = auth()->user()->id;
        $input['status'] = isset($input['status']) ? 1 : 0;

        if ($page->update($input)) {

            event(new PageUpdated($page));
            return $page;
        }

        throw new GeneralException(
            trans('exceptions.backend.access.pages.update_error')
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

        throw new GeneralException(trans('exceptions.backend.access.pages.delete_error'));
    }
}
