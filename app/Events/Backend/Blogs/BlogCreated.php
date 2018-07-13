<?php

namespace App\Events\Backend\Blogs;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogCreated.
 */
class BlogCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $blogs;

    /**
     * @param $blogs
     */
    public function __construct($blogs)
    {
        $this->blogs = $blogs;
    }
}
