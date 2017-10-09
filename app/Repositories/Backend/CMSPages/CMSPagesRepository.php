<?php

namespace App\Repositories\Backend\CMSPages;

use App\Events\Backend\CMSPages\CMSPageCreated;
use App\Events\Backend\CMSPages\CMSPageDeleted;
use App\Events\Backend\CMSPages\CMSPageUpdated;
use App\Exceptions\GeneralException;
use App\Models\CMSPages\CMSPage;
use App\Repositories\BaseRepository;
use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CMSPagesRepository.
 */
class CMSPagesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = CMSPage::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.cms_pages_table').'.id',
                config('access.cms_pages_table').'.title',
                config('access.cms_pages_table').'.status',
                config('access.cms_pages_table').'.created_at',
                config('access.cms_pages_table').'.updated_at',
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
            throw new GeneralException(trans('exceptions.backend.cmspages.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $cmspages = self::MODEL;
            $cmspages = new $cmspages();
            $cmspages->title = $input['title'];
            $cmspages->page_slug = str_slug($input['title']);
            $cmspages->description = $input['description'];
            $cmspages->cannonical_link = $input['cannonical_link'];
            $cmspages->seo_title = $input['seo_title'];
            $cmspages->seo_keyword = $input['seo_keyword'];
            $cmspages->seo_description = $input['seo_description'];
            $cmspages->status = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
            $cmspages->created_by = access()->user()->id;

            if ($cmspages->save()) {
                event(new CMSPageCreated($cmspages));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.cmspages.create_error'));
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
    public function update(Model $cmspages, array $input)
    {
        if ($this->query()->where('title', $input['title'])->where('id', '!=', $cmspages->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.cmspages.already_exists'));
        }
        $cmspages->title = $input['title'];
        $cmspages->page_slug = str_slug($input['title']);
        $cmspages->description = $input['description'];
        $cmspages->cannonical_link = $input['cannonical_link'];
        $cmspages->seo_title = $input['seo_title'];
        $cmspages->seo_keyword = $input['seo_keyword'];
        $cmspages->seo_description = $input['seo_description'];
        $cmspages->status = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
        $cmspages->updated_by = access()->user()->id;

        DB::transaction(function () use ($cmspages, $input) {
            if ($cmspages->save()) {
                event(new CMSPageUpdated($cmspages));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.cmspages.update_error'));
        });
    }

    /**
     * @param Model $cmspage
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $cmspage)
    {
        DB::transaction(function () use ($cmspage) {
            if ($cmspage->delete()) {
                event(new CMSPageDeleted($cmspage));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.cmspages.delete_error'));
        });
    }
}
