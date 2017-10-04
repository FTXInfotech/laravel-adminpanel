<?php

namespace App\Models\BlogTags;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogTags\Traits\Attribute\BlogTagAttribute;
use App\Models\BlogTags\Traits\Relationship\BlogTagRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTag extends Model
{
     use BlogTagAttribute,
        SoftDeletes,
        BlogTagRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["name", "status", "created_by", "updated_by"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.blog_tags_table");
    }
}
