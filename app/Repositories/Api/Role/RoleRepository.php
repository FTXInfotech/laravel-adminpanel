<?php

namespace App\Repositories\Api\Role;

use App\Models\Access\Role\Role;
use App\Repositories\BaseRepository;
use App\Models\BaseModel;

/**
 * Class RoleRepository.
 */
class RoleRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Role::class;

    /**
     * @return mixed
     */
    public function getDefaultUserRole()
    {
        if (is_numeric(config('access.users.default_role'))) {
            return $this->query()->where('id', (int) config('access.users.default_role'))->first();
        }

        return $this->query()->where('name', config('access.users.default_role'))->first();
    }
}
