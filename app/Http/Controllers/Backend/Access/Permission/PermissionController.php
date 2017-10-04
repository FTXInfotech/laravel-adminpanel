<?php

namespace App\Http\Controllers\Backend\Access\Permission;

use App\Models\Access\Permission\Permission;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Access\Permission\PermissionRepository;
use App\Http\Requests\Backend\Access\Permission\StorePermissionRequest;
use App\Http\Requests\Backend\Access\Permission\ManagePermissionRequest;
use App\Http\Requests\Backend\Access\Permission\CreatePermissionRequest;
use App\Http\Requests\Backend\Access\Permission\EditPermissionRequest;
use App\Http\Requests\Backend\Access\Permission\DeletePermissionRequest;
use App\Http\Requests\Backend\Access\Permission\UpdatePermissionRequest;

/**
 * Class PermissionController.
 */
class PermissionController extends Controller
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
    public function index(ManagePermissionRequest $request)
    {
        return view('backend.access.permissions.index');
    }

    /**
     * @param CreatePermissionRequest $request
     *
     * @return mixed
     */
    public function create(CreatePermissionRequest $request)
    {
        return view('backend.access.permissions.create')
                ->withPermissionCount($this->permissions->getCount());
    }

    /**
     * @param StorePermissionRequest $request
     *
     * @return mixed
     */
    public function store(StorePermissionRequest $request)
    {
        $this->permissions->create($request->all());

        return redirect()->route('admin.access.permission.index')->withFlashSuccess(trans('alerts.backend.permissions.created'));
    }

    /**
     * @param Permission              $permission
     * @param EditPermissionRequest $request
     *
     * @return mixed
     */
    public function edit(Permission $permission, EditPermissionRequest $request)
    {
        return view('backend.access.permissions.edit')
            ->withPermission($permission);
    }

    /**
     * @param Permission              $permission
     * @param UpdatePermissionRequest $request
     *
     * @return mixed
     */
    public function update(Permission $permission, UpdatePermissionRequest $request)
    {
        $this->permissions->update($permission, $request->all());

        return redirect()->route('admin.access.permission.index')->withFlashSuccess(trans('alerts.backend.permissions.updated'));
    }

    /**
     * @param Permission              $permission
     * @param DeletePermissionRequest $request
     *
     * @return mixed
     */
    public function destroy(Permission $permission, DeletePermissionRequest $request)
    {
        $this->permissions->delete($permission);

        return redirect()->route('admin.access.permission.index')->withFlashSuccess(trans('alerts.backend.permissions.deleted'));
    }
}
