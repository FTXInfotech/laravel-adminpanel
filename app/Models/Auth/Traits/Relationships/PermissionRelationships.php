<?php

namespace App\Models\AuthTraits\Relationships;

use App\Models\Auth\Role;

trait PermissionRelationships
{
    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
