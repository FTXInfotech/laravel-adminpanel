<?php

namespace App\Events\Backend\CMSPages;

use Illuminate\Queue\SerializesModels;

/**
 * Class CMSPageCreated.
 */
class CMSPageCreated
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
