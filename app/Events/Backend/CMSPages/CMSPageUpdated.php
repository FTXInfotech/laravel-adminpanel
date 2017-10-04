<?php

namespace App\Events\Backend\CMSPages;

use Illuminate\Queue\SerializesModels;

/**
 * Class CMSPageUpdated.
 */
class CMSPageUpdated
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
