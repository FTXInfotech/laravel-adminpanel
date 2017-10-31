<?php

namespace App\Models\Blogs;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Blogs\Traits\Attribute\BlogAttribute;
use App\Models\Blogs\Traits\Relationship\BlogRelationship;

class Blog extends Model
{
    use ModelTrait,
        SoftDeletes,
        BlogAttribute,
        BlogRelationship {
            // BlogAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.blogs_table');
    }
}
