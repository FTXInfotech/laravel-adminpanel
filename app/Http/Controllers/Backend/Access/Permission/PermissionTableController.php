<?php

namespace App\Http\Controllers\Backend\Access\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\Permission\ManagePermissionRequest;
use App\Repositories\Backend\Access\Permission\PermissionRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PermissionTableController.
 */
class PermissionTableController extends Controller
{
    /**
     * @var PermissionRepository
     */
    protected $permissions;

    /**
     * @param PermissionRepository $permissions
     */
    public function __construct(PermissionRepository $permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @param ManagePermissionRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManagePermissionRequest $request)
    {
        return Datatables::of($this->permissions->getForDataTable())
            ->escapeColumns(['name', 'sort'])
            ->addColumn('permissions', function ($permission) {
                if ($permission->all) {
                    return '<span class="label label-success">'.trans('labels.general.all').'</span>';
                }
            })
            ->addColumn('actions', function ($permission) {
                return $permission->action_buttons;
            })
            ->make(true);
    }
}
