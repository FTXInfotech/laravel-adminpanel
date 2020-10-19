<?php

namespace App\Models\Auth;

use App\Models\BaseModel;
use App\Models\Traits\ModelAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Traits\Attributes\PermissionAttributes;
use App\Models\Auth\Traits\Relationships\PermissionRelationships;

/**
 * Class Permission.
 */
class Permission extends BaseModel
{
    use ModelAttributes, SoftDeletes, PermissionAttributes, PermissionRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'sort'];

    protected $attributes = [
        'created_by' => 1,
    ];
}
