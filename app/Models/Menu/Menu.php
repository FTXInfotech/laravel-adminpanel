<?php

namespace App\Models\Menu;

use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Menu\Traits\Attribute\MenuAttribute;

class Menu extends Model
{
    use ModelTrait,
        SoftDeletes,
        MenuAttribute {
            // MenuAttribute::getEditButtonAttribute insteadof ModelTrait;
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
        $this->table = config('access.menus_table');
    }
}
