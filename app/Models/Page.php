<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Traits\Attributes\PageAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\PageRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends BaseModel
{   
    use SoftDeletes, ModelAttributes, PageRelationships, PageAttributes;

    /**
     * The guarded field which are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'created_by' => 1,
    ];

    protected $with = ['owner'];
}
