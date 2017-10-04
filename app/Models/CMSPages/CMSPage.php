<?php

namespace App\Models\CMSPages;

use Illuminate\Database\Eloquent\Model;
use App\Models\CMSPages\Traits\Attribute\CMSPageAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class CMSPage extends Model
{
    use CMSPageAttribute,
        SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.cms_pages_table");
    }
}
