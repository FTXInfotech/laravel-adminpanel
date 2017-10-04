<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blogs\Traits\Attribute\BlogAttribute;
use App\Models\Blogs\Traits\Relationship\BlogRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use BlogAttribute,
    	BlogRelationship,
        SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.blogs_table");
    }
}
