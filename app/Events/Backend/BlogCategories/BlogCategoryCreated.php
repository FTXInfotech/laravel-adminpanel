<?php

namespace App\Events\Backend\BlogCategories;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogCategoryCreated.
 */
class BlogCategoryCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $blogcategories;

    /**
     * @param $blogcategories
     */
    public function __construct($blogcategories)
    {
        $this->blogcategories = $blogcategories;
    }
}
