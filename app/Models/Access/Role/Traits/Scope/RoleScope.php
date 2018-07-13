<?php

namespace App\Models\Access\Role\Traits\Scope;

/**
 * Class RoleScope.
 */
trait RoleScope
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
