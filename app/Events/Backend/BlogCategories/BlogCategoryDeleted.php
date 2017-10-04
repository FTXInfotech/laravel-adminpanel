<?php

namespace App\Events\Backend\BlogCategories;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogCategoryDeleted.
 */
class BlogCategoryDeleted
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
