<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu\Traits\Attribute\MenuAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use MenuAttribute,
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
    	$this->table = config("access.menus_table");
    }
}
