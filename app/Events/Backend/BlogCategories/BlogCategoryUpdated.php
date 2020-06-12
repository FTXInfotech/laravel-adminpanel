<?php

namespace App\Events\Backend\BlogCategories;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogCategoryUpdated.
 */
class BlogCategoryUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $blogcategory;

    /**
     * @param $blogcategory
     */
    public function __construct($blogcategory)
    {
        $this->blogcategory = $blogcategory;
    }
}
