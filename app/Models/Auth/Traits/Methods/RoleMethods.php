<?php

namespace App\Models\Auth\Traits\Methods;

trait RoleMethods
{
    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->name === config('access.users.admin_role');
    }
}
