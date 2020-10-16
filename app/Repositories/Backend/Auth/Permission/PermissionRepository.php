<?php

namespace App\Repositories\Backend\Auth\Permission;

use App\Events\Backend\Auth\Permission\PermissionCreated;
use App\Events\Backend\Auth\Permission\PermissionDeleted;
use App\Events\Backend\Auth\Permission\PermissionUpdated;
use App\Exceptions\GeneralException;
use App\Models\Auth\Permission\Permission;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends BaseRepository
{
    /**
     * RoleRepository constructor.
     *
     * @param  Role  $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                'permissions.id',
                'permissions.name',
                'permissions.display_name',
                'permissions.sort',
                'permissions.created_at',
                'permissions.updated_at',
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
            $permission = new Permission();
            $permission->name = $input['name'];
            $permission->display_name = $input['display_name'];
            $permission->sort = isset($input['sort']) && strlen($input['sort']) > 0 && is_numeric($input['sort']) ? (int) $input['sort'] : 0;
            $permission->status = 1;
            $permission->created_by = auth()->user()->id;

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
        $permission->updated_by = auth()->user()->id;

        DB::transaction(function () use ($permission) {
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
