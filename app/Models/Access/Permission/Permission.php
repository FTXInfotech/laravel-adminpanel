<?php

namespace App\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Attribute\PermissionAttribute;
use App\Models\Access\Permission\Traits\Relationship\PermissionRelationship;
use App\Models\BaseModel;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Permission.
 */
class Permission extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        PermissionAttribute,
        PermissionRelationship {
            // PermissionAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'sort'];

    protected $attributes = [
        'created_by' => 1,
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.permissions_table');
    }
}
