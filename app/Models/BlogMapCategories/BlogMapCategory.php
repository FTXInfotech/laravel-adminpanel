<?php

namespace App\Models\BlogMapCategories;

use Illuminate\Database\Eloquent\Model;

class BlogMapCategory extends Model
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
