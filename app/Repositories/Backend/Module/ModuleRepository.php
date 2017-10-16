<?php

namespace App\Repositories\Backend\Module;

use App\Exceptions\GeneralException;
use App\Models\Access\Permission\Permission;
use App\Models\Module\Module;
use App\Repositories\BaseRepository;

/**
 * Class ModuleRepository.
 */
class ModuleRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Module::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin(config('access.users_table'), config('access.users_table').'.id', '=', config('module.table').'.created_by')
            ->select([
                config('module.table').'.id',
                config('module.table').'.name',
                config('module.table').'.url',
                config('module.table').'.view_permission_id',
                config('module.table').'.created_by',
                config('module.table').'.updated_by',
                config('access.users_table').'.first_name as created_by',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input, array $permissions)
    {
        $module = Module::where('name', $input['name'])->first();
        if (!$module) {
            $name = $input['model_name'];
            $model = strtolower($name);
            // $permissions =
            // [
            //     ['name' => "view-$model-permission", 'display_name' => 'View '.ucwords($model).' Permission'],
            //     ['name' => "create-$model-permission", 'display_name' => 'Create '.ucwords($model).' Permission'],
            //     ['name' => "edit-$model-permission", 'display_name' => 'Edit '.ucwords($model).' Permission'],
            //     ['name' => "delete-$model-permission", 'display_name' => 'Delete '.ucwords($model).' Permission'],
            // ];

            foreach ($permissions as $permission) {
                $perm = [
                    'name' => $permission,
                    'display_name' => title_case( str_replace( '-', ' ', $permission ) ) . " Permission"
                ];
                //Creating Permission
                $per = Permission::firstOrCreate($perm);
            }

            $mod = [
                'view_permission_id'    => "view-$model-permission",
                'name'                  => $input['name'],
                'url'                   => 'admin.' . str_plural( $model ) . '.index',
                'created_by'            => access()->user()->id,
            ];

            $create = Module::create($mod);

            return $create;
        }

        throw new GeneralException(trans('exceptions.backend.modules.create_error'));
    }

    /**
     * @param $module
     * @param  $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update($module, array $input)
    {
        $module->name = $input['name'];
        $module->view_permission_id = $input['view_permission_id'];
        $module->url = $input['url'];
        $module->updated_by = access()->user()->id;

        if ($module->update()) {
            return true;
        }

        throw new GeneralException(
            trans('exceptions.backend.modules.update_error')
        );
    }
}
