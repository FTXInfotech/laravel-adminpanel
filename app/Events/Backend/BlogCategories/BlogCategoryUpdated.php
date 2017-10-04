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
    public $blogcategories;

    /**
     * @param $blogcategories
     */
    public function __construct($blogcategories)
    {
        $this->blogcategories = $blogcategories;
    }
}
