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
    public $blogtags;

    /**
     * @param $blogtags
     */
    public function __construct($blogtags)
    {
        $this->blogtags = $blogtags;
    }
}
