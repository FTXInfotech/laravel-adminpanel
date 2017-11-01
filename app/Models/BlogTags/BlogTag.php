<?php

namespace App\Models\BlogTags;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BlogTags\Traits\Attribute\BlogTagAttribute;
use App\Models\BlogTags\Traits\Relationship\BlogTagRelationship;

class BlogTag extends Model
{
    use ModelTrait,
        SoftDeletes,
        BlogTagAttribute,
        BlogTagRelationship{
            // BlogTagAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ['name', 'status', 'created_by', 'updated_by'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.blog_tags_table');
    }
}
