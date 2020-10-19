<?php

namespace App\Http\Controllers\Backend\Auth\Role;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Http\Requests\Backend\Auth\Role\ManageRoleRequest;

/**
 * Class RoleTableController.
 */
class RoleTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Auth\RoleRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\Auth\RoleRepository $roles
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\Role\ManageRoleRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageRoleRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name', 'sort'])
            ->addColumn('permissions', function ($role) {
                if ($role->all) {
                    return '<span class="label label-success">'.trans('labels.general.all').'</span>';
                }

                return $role->permission_name;
            })
            ->addColumn('users', function ($role) {
                return $role->userCount;
            })
            ->addColumn('actions', function ($role) {
                return $role->action_buttons;
            })
            ->make(true);
    }
}
