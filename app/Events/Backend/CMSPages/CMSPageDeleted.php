<?php

namespace App\Events\Backend\CMSPages;

use Illuminate\Queue\SerializesModels;

/**
 * Class CMSPageDeleted.
 */
class CMSPageDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $cmspages;

    /**
     * @param $cmspages
     */
    public function __construct($cmspages)
    {
        $this->cmspages = $cmspages;
    }
}
