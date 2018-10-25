<?php

namespace App\Repositories\Backend\Access\Permission;

use App\Events\Backend\Access\Permission\PermissionCreated;
use App\Events\Backend\Access\Permission\PermissionDeleted;
use App\Events\Backend\Access\Permission\PermissionUpdated;
use App\Exceptions\GeneralException;
use App\Models\Access\Permission\Permission;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Permission::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                config('access.permissions_table').'.id',
                config('access.permissions_table').'.name',
                config('access.permissions_table').'.display_name',
                config('access.permissions_table').'.sort',
                config('access.permissions_table').'.created_at',
                config('access.permissions_table').'.updated_at',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.access.permissions.already_exists'));
        }

        DB::transaction(function () use ($input) {
            $permission = self::MODEL;
            $permission = new $permission();
            $permission->name = $input['name'];
            $permission->display_name = $input['display_name'];
            $permission->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;
            $permission->status = 1;
            $permission->created_by = access()->user()->id;

            if ($permission->save()) {
                event(new PermissionCreated($permission));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.permissions.create_error'));
        });
    }

    /**
     * @param Model $permission
     * @param  $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($permission, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '!=', $permission->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.access.permissions.already_exists'));
        }

        $permission->name = $input['name'];
        $permission->display_name = $input['display_name'];
        $permission->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;
        $permission->status = 1;
        $permission->updated_by = access()->user()->id;

        DB::transaction(function () use ($permission, $input) {
            if ($permission->save()) {
                event(new PermissionUpdated($permission));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.permission.update_error'));
        });
    }

    /**
     * @param Model $permission
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete($permission)
    {
        DB::transaction(function () use ($permission) {
            if ($permission->delete()) {
                event(new PermissionDeleted($permission));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.permission.delete_error'));
        });
    }
}
