<?php

namespace App\Models;

use App\Models\Traits\Attributes\BlogAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\BlogRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends BaseModel
{
    use ModelAttributes, SoftDeletes, BlogAttributes, BlogRelationships;

    protected $fillable = [
        'name',
        'slug',
        'publish_datetime',
        'content',
        'meta_title',
        'cannonical_link',
        'meta_keywords',
        'meta_description',
        'status',
        'featured_image',
        'created_by',
    ];

    protected $dates = [
        'publish_datetime',
        'created_at',
        'updated_at',
    ];
}
