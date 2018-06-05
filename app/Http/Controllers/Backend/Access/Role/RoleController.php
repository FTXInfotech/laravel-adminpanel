<?php

namespace App\Http\Controllers\Backend\Access\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\Role\CreateRoleRequest;
use App\Http\Requests\Backend\Access\Role\DeleteRoleRequest;
use App\Http\Requests\Backend\Access\Role\EditRoleRequest;
use App\Http\Requests\Backend\Access\Role\ManageRoleRequest;
use App\Http\Requests\Backend\Access\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Access\Role\UpdateRoleRequest;
use App\Http\Responses\Backend\Access\Role\CreateResponse;
use App\Http\Responses\Backend\Access\Role\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Access\Role\Role;
use App\Repositories\Backend\Access\Permission\PermissionRepository;
use App\Repositories\Backend\Access\Role\RoleRepository;

/**
 * Class RoleController.
 */
class RoleController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Access\Role\RoleRepository
     */
    protected $roles;

    /**
     * @var \App\Repositories\Backend\Access\Permission\PermissionRepository
     */
    protected $permissions;

    /**
     * @param \App\Repositories\Backend\Access\Role\RoleRepository             $roles
     * @param \App\Repositories\Backend\Access\Permission\PermissionRepository $permissions
     */
    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * @param \App\Http\Requests\Backend\Access\Role\ManageRoleRequest $request
     *
     * @return mixed
     */
    public function index(ManageRoleRequest $request)
    {
        return new ViewResponse('backend.access.roles.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Access\Role\CreateRoleRequest $request
     *
     * @return \App\Http\Responses\Backend\Access\Role\CreateResponse
     */
    public function create(CreateRoleRequest $request)
    {
        return new CreateResponse($this->permissions, $this->roles);
    }

    /**
     * @param \App\Http\Requests\Backend\Access\Role\StoreRoleRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roles->create($request->all());

        return new RedirectResponse(route('admin.access.role.index'), ['flash_success' => trans('alerts.backend.roles.created')]);
    }

    /**
     * @param \App\Models\Access\Role\Role                           $role
     * @param \App\Http\Requests\Backend\Access\Role\EditRoleRequest $request
     *
     * @return \App\Http\Responses\Backend\Access\Role\EditResponse
     */
    public function edit(Role $role, EditRoleRequest $request)
    {
        return new EditResponse($role, $this->permissions);
    }

    /**
     * @param \App\Models\Access\Role\Role                             $role
     * @param \App\Http\Requests\Backend\Access\Role\UpdateRoleRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->roles->update($role, $request->all());

        return new RedirectResponse(route('admin.access.role.index'), ['flash_success' => trans('alerts.backend.roles.updated')]);
    }

    /**
     * @param \App\Models\Access\Role\Role                             $role
     * @param \App\Http\Requests\Backend\Access\Role\DeleteRoleRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Role $role, DeleteRoleRequest $request)
    {
        $this->roles->delete($role);

        return new RedirectResponse(route('admin.access.role.index'), ['flash_success' => trans('alerts.backend.roles.deleted')]);
    }
}
