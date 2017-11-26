<?php

namespace App\Repositories\Api\CmsPage;

use App\Exceptions\GeneralException;
use App\Models\CMSPages\CMSPage;
use App\Repositories\BaseRepository;
use App\Models\BaseModel;

/**
 * Class CmsPageRepository.
 */
class CmsPageRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = CMSPage::class;

    /**
     * Check given user is exist or not.
     *
     * @return mixed
     */
    public function findBySlug($page_slug)
    {
        if (count($this->query()->wherePage_slug($page_slug)->get()) > 0) {
            return $this->query()->wherePage_slug($page_slug)->get()->toArray();
        }

        throw new GeneralException(trans('exceptions.api.cmspage.not_found'));
    }
}
