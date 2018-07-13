<?php

namespace App\Events\Backend\BlogTags;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogTagUpdated.
 */
class BlogTagUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $blogtag;

    /**
     * @param $blogtag
     */
    public function __construct($blogtag)
    {
        $this->blogtag = $blogtag;
    }
}
