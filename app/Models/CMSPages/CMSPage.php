<?php

namespace App\Models\CMSPages;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CMSPages\Traits\Attribute\CMSPageAttribute;

class CMSPage extends Model
{
    use ModelTrait,
        SoftDeletes,
        CMSPageAttribute {
            // CMSPageAttribute::getEditButtonAttribute insteadof ModelTrait;
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
