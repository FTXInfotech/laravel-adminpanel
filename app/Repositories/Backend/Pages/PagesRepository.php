<?php

namespace App\Repositories\Backend\Pages;

use App\Events\Backend\Pages\PageCreated;
use App\Events\Backend\Pages\PageDeleted;
use App\Events\Backend\Pages\PageUpdated;
use App\Exceptions\GeneralException;
use App\Models\Page\Page;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class PagesRepository.
 */
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
            ->select([
                config('access.pages_table').'.id',
                config('access.pages_table').'.title',
                config('access.pages_table').'.status',
                config('access.pages_table').'.created_at',
                config('access.pages_table').'.updated_at',
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
        if ($this->query()->where('title', $input['title'])->first()) {
            throw new GeneralException(trans('exceptions.backend.pages.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $pages = self::MODEL;
            $pages = new $pages();
            $pages->title = $input['title'];
            $pages->page_slug = str_slug($input['title']);
            $pages->description = $input['description'];
            $pages->cannonical_link = $input['cannonical_link'];
            $pages->seo_title = $input['seo_title'];
            $pages->seo_keyword = $input['seo_keyword'];
            $pages->seo_description = $input['seo_description'];
            $pages->status = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
            $pages->created_by = access()->user()->id;

            if ($pages->save()) {
                event(new PageCreated($pages));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.pages.create_error'));
        });
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * return bool
     */
    public function update(Model $page, array $input)
    {
        if ($this->query()->where('title', $input['title'])->where('id', '!=', $page->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.pages.already_exists'));
        }
        $page->title = $input['title'];
        $page->page_slug = str_slug($input['title']);
        $page->description = $input['description'];
        $page->cannonical_link = $input['cannonical_link'];
        $page->seo_title = $input['seo_title'];
        $page->seo_keyword = $input['seo_keyword'];
        $page->seo_description = $input['seo_description'];
        $page->status = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
        $page->updated_by = access()->user()->id;

        DB::transaction(function () use ($page, $input) {
            if ($page->save()) {
                event(new PageUpdated($page));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.pages.update_error'));
        });
    }

    /**
     * @param Model $page
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $page)
    {
        DB::transaction(function () use ($page) {
            if ($page->delete()) {
                event(new PageDeleted($page));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.pages.delete_error'));
        });
    }
}
