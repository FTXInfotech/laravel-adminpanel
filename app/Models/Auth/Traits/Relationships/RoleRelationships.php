<?php

namespace App\Models\Auth\Traits\Relationships;

use App\Models\Auth\Permission;
use App\Models\Auth\User;

trait RoleRelationships
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
        return $this->belongsToMany(Permission::class)->orderBy('display_name', 'asc');
    }
}
