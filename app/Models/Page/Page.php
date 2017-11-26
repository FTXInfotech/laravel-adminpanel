<?php

namespace App\Models\Page;

use App\Models\BaseModel;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Page\Traits\Attribute\PageAttribute;

class Page extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        PageAttribute {
            // PageAttribute::getEditButtonAttribute insteadof ModelTrait;
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
        $this->table = config('access.cms_pages_table');
    }
}
