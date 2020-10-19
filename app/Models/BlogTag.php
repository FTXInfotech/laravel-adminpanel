<?php

namespace App\Models;

use App\Models\Traits\Attributes\BlogTagAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\BlogTagRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTag extends BaseModel
{
    use ModelAttributes, SoftDeletes, BlogTagAttributes, BlogTagRelationships;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by',
    ];

    /**
     * Casts.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Appends.
     *
     * @var array
     */
    protected $appends = [
        'display_status',
    ];
}
