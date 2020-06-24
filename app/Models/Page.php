<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\ModelTrait;
use App\Models\Traits\Page\PageAttributes;
use App\Models\Traits\Page\PageRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends BaseModel
{   
    use SoftDeletes, ModelTrait, PageRelationships, PageAttributes;

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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
