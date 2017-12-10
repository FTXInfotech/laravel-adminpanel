<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelTrait;
use App\Models\Menu\Traits\Attribute\MenuAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use ModelTrait,
        MenuAttribute,
        SoftDeletes{
            // MenuAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = [
        'name',
        'type',
        'items'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.menus_table");
    }
}
