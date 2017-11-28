<?php

namespace App\Models\BlogMapCategories;

use App\Models\BaseModel;

class BlogMapCategory extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.blog_map_categories_table');
    }
}
