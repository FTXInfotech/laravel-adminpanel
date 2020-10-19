<?php

namespace App\Repositories\Backend\Auth;

use App\Events\Backend\Auth\Role\RoleCreated;
use App\Events\Backend\Auth\Role\RoleDeleted;
use App\Events\Backend\Auth\Role\RoleUpdated;
use App\Exceptions\GeneralException;
use App\Models\Auth\Role;
use App\Repositories\BaseRepository;
use DB;

class RoleRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Role::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftJoin('permission_role', 'permission_role.role_id', '=', 'roles.id')
            ->leftJoin('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->select([
                'roles.id',
                'roles.name',
                'roles.all',
                'roles.sort',
                'roles.status',
                'roles.created_at',
                'roles.updated_at',
                DB::raw("GROUP_CONCAT( DISTINCT permissions.display_name SEPARATOR '<br/>') as permission_name"),
                DB::raw('(SELECT COUNT(role_user.id) FROM role_user LEFT JOIN users ON role_user.user_id = users.id WHERE role_user.role_id = roles.id AND users.deleted_at IS NULL) AS userCount'),
            ])
            ->groupBy('roles.id');
    }

    /**
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return \App\Models\Auth\Role
     */
    public function create(array $input)
    {
        //See if the role has all access
        $all = $input['associated_permissions'] == 'all' ? true : false;

        if (! isset($input['permissions'])) {
            $input['permissions'] = [];
        }

        //This config is only required if all is false
        if (! $all) {
            //See if the role must contain a permission as per config
            if (config('access.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                throw new GeneralException(__('exceptions.backend.access.roles.needs_permission'));
            }
        }

        DB::transaction(function () use ($input, $all) {
            $role = new Role();
            $role->name = $input['name'];
            $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;

            //See if this role has all permissions and set the flag on the role
            $role->all = $all;

            $role->status = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
            $role->created_by = access()->user()->id;

            if ($role->save()) {
                if (! $all) {
                    $permissions = [];

                    if (is_array($input['permissions']) && count($input['permissions'])) {
                        foreach ($input['permissions'] as $perm) {
                            if (is_numeric($perm)) {
                                array_push($permissions, $perm);
                            }
                        }
                    }

                    $role->attachPermissions($permissions);
                }

                event(new RoleCreated($role));

                return true;
            }

            throw new GeneralException(__('exceptions.backend.access.roles.create_error'));
        });
    }

    /**
     * @param \App\Models\Auth\Role  $role
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Role $role, array $input)
    {
        //See if the role has all access, administrator always has all access
        if ($role->id == 1) {
            $all = true;
        } else {
            $all = $input['associated_permissions'] == 'all' ? true : false;
        }

        if (! isset($input['permissions'])) {
            $input['permissions'] = [];
        }

        //This config is only required if all is false
        if (! $all) {
            //See if the role must contain a permission as per config
            if (config('access.roles.role_must_contain_permission') && count($input['permissions']) == 0) {
                throw new GeneralException(__('exceptions.backend.access.roles.needs_permission'));
            }
        }

        $role->name = $input['name'];
        $role->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;

        //See if this role has all permissions and set the flag on the role
        $role->all = $all;

        $role->status = (isset($input['status']) && $input['status'] == 1) ? 1 : 0;
        $role->updated_by = access()->user()->id;

        DB::transaction(function () use ($role, $input, $all) {
            if ($role->save()) {
                //If role has all access detach all permissions because they're not needed
                if ($all) {
                    $role->permissions()->sync([]);
                } else {
                    //Remove all roles first
                    $role->permissions()->sync([]);

                    //Attach permissions if the role does not have all access
                    $permissions = [];

                    if (is_array($input['permissions']) && count($input['permissions'])) {
                        foreach ($input['permissions'] as $perm) {
                            if (is_numeric($perm)) {
                                array_push($permissions, $perm);
                            }
                        }
                    }

                    $role->attachPermissions($permissions);
                }

                event(new RoleUpdated($role));

                return true;
            }

            throw new GeneralException(__('exceptions.backend.access.roles.update_error'));
        });
    }

    /**
     * @param $name
     *
     * @return bool
     */
    protected function roleExists($name): bool
    {
        return $this->query()
            ->where('name', strtolower($name))
            ->count() > 0;
    }

    /**
     * @param \App\Models\Auth\Role $role
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Role $role)
    {
        //Would be stupid to delete the administrator role
        if ($role->id == 1) { //id is 1 because of the seeder
            throw new GeneralException(__('exceptions.backend.access.roles.cant_delete_admin'));
        }

        //Don't delete the role is there are users associated
        if ($role->users()->count() > 0) {
            throw new GeneralException(__('exceptions.backend.access.roles.has_users'));
        }

        return DB::transaction(function () use ($role) {
            //Detach all associated roles
            $role->permissions()->sync([]);

            if ($role->delete()) {
                event(new RoleDeleted($role));

                return true;
            }

            throw new GeneralException(__('exceptions.backend.access.roles.delete_error'));
        });
    }
}
