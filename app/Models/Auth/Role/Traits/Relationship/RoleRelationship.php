<?php

namespace App\Models\Auth\Role\Traits\Relationship;

use App\Models\Auth\Permission\Permission;
use App\Models\Auth\User;

/**
 * Class RoleRelationship.
 */
trait RoleRelationship
{
    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)
            ->orderBy('display_name', 'asc');
    }
}
