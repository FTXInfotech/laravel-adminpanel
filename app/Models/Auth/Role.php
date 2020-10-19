<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Access\RoleAccess;
use App\Models\Auth\Traits\Attributes\RoleAttributes;
use App\Models\Auth\Traits\Relationships\RoleRelationships;
use App\Models\Auth\Traits\Scopes\RoleScopes;
use App\Models\BaseModel;
use App\Models\Traits\ModelAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends BaseModel
{
    use ModelAttributes, RoleScopes, RoleAccess, RoleAttributes, RoleRelationships,
        SoftDeletes {
            RoleAttributes::getEditButtonAttribute insteadof ModelAttributes;
            RoleAttributes::getDeleteButtonAttribute insteadof ModelAttributes;
        }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'all', 'sort'];
}
