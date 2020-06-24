<?php

namespace App\Models;

use App\Models\Traits\Attributes\BlogTagAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\BlogTagRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTag extends BaseModel
{
    use ModelAttributes, SoftDeletes, BlogTagAttributes, BlogTagRelationships;

    protected $fillable = ['name', 'status', 'created_by', 'updated_by'];

}
