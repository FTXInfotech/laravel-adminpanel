<?php

namespace App\Http\Controllers\Backend\Auth\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\Permission\ManagePermissionRequest;
use App\Repositories\Backend\Auth\PermissionRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class PermissionTableController.
 */
class PermissionTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Auth\PermissionRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\Auth\PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param App\Http\Requests\Backend\Auth\Permission\ManagePermissionRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManagePermissionRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
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
