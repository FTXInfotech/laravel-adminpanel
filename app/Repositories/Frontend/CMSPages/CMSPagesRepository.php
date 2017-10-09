<?php

namespace App\Repositories\Frontend\CMSPages;

use App\Exceptions\GeneralException;
use App\Models\CMSPages\CMSPage;
use App\Repositories\BaseRepository;
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

    /*
    * Find cmspage by pageslug
    */
    public function findBySlug($page_slug)
    {
        if (!is_null($this->query()->wherePage_slug($page_slug)->firstOrFail())) {
            return $this->query()->wherePage_slug($page_slug)->firstOrFail();
        }

        throw new GeneralException(trans('exceptions.backend.access.cmspages.not_found'));
    }
}
