<?php

namespace App\Models;

use App\Models\Traits\Attributes\BlogCategoryAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\BlogCategoryRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends BaseModel
{
    use ModelAttributes, SoftDeletes, BlogCategoryAttributes, BlogCategoryRelationships;

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
