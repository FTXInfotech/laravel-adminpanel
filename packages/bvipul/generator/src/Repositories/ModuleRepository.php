<?php

namespace Bvipul\Generator\Repositories;

use Bvipul\Generator\Module;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\Access\Permission\Permission;

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
            ->leftjoin('users', 'users.id', '=', 'modules.created_by')
            ->select([
                'modules.id',
                'modules.name',
                'modules.url',
                'modules.view_permission_id',
                'modules.created_by',
                'modules.updated_by',
                'users.first_name as created_by',
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

            foreach ($permissions as $permission) {
                $perm = [
                    'name'         => $permission,
                    'display_name' => title_case(str_replace('-', ' ', $permission)).' Permission',
                ];
                //Creating Permission
                $per = Permission::firstOrCreate($perm);
            }

            $mod = [
                'view_permission_id' => "view-$model-permission",
                'name'               => $input['name'],
                'url'                => 'admin.'.str_plural($model).'.index',
                'created_by'         => access()->user()->id,
            ];

            $create = Module::create($mod);

            return $create;
        }
        else {
            return $module;
        }

        throw new GeneralException('There was some error in creating the Module. Please Try Again.');
    }
}
