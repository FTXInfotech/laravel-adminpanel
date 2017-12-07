<?php

namespace App\Events\Backend\BlogTags;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogTagCreated.
 */
class BlogTagCreated
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
