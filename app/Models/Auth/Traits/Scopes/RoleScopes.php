<?php

namespace App\Models\Auth\Traits\Scopes;

trait RoleScopes
{
    /**
     * @param $query
     * @param string $direction
     *
     * @return mixed
     */
    public function scopeSort($query, $direction = 'asc')
    {
        return $query->orderBy('sort', $direction);
    }
}
