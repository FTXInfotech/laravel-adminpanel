<?php

namespace App\Models\BlogMapTags;

use App\Models\BaseModel;

class BlogMapTag extends BaseModel
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
        $this->table = config('access.blog_map_tags');
    }
}
