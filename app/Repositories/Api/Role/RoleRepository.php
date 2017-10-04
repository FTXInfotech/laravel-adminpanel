<?php

namespace App\Repositories\Api\Role;

use App\Models\Access\Role\Role;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

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

