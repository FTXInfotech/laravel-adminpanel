<?php

namespace App\Http\Controllers\Backend\Auth\Role;

use App\Events\Backend\Auth\Role\RoleDeleted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\Role\EditRoleRequest;
use App\Http\Requests\Backend\Auth\Role\ManageRoleRequest;
use App\Http\Requests\Backend\Auth\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Auth\Role\UpdateRoleRequest;
use App\Http\Responses\Backend\Auth\Role\CreateResponse;
use App\Http\Responses\Backend\Auth\Role\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Auth\Role\Role;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\RoleRepository;

/**
 * Class RoleController.
 */
class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * @var PermissionRepository
     */
    protected $permissions;

    /**
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roles        = $roleRepository;
        $this->permissions  = $permissionRepository;
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function index(ManageRoleRequest $request)
    {
        return new ViewResponse('backend.auth.roles.index');
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return CreateResponse
     */
    public function create(ManageRoleRequest $request)
    {
        return new CreateResponse($this->permissions, $this->roles);
    }

    /**
     * @param  StoreRoleRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roles->create($request->all());

        return new RedirectResponse(route('admin.auth.role.index'), ['flash_success' => trans('alerts.backend.roles.created')]);
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $role
     *
     * @return EditResponse
     */
    public function edit(Role $role, EditRoleRequest $request)
    {
        return new EditResponse($role, $this->permissions);
    }

    /**
     * @param  UpdateRoleRequest  $request
     * @param  Role  $role
     *
     * @return RedirectResponse
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->roles->update($role, $request->all());

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('alerts.backend.roles.updated'));
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $role
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageRoleRequest $request, Role $role)
    {
        $this->roles->delete($role);

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('alerts.backend.roles.deleted'));
    }
}
