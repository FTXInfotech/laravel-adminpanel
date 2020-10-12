<?php

namespace App\Models;

use App\Models\Traits\ModelAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Attributes\BlogCategoryAttributes;
use App\Models\Traits\Relationships\BlogCategoryRelationships;

class BlogCategory extends BaseModel
{
    use ModelAttributes, SoftDeletes, BlogCategoryAttributes, BlogCategoryRelationships;

    protected $fillable = ['name', 'status', 'created_by', 'updated_by'];
}
