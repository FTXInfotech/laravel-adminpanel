<?php

namespace App\Http\Controllers\Backend\Auth\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\Role\EditRoleRequest;
use App\Http\Requests\Backend\Auth\Role\ManageRoleRequest;
use App\Http\Requests\Backend\Auth\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Auth\Role\UpdateRoleRequest;
use App\Http\Responses\Backend\Auth\Role\CreateResponse;
use App\Http\Responses\Backend\Auth\Role\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Auth\Role;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\RoleRepository;
use Illuminate\Support\Facades\View;

class RoleController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Auth\RoleRepository
     */
    protected $roleRepository;

    /**
     * @var \App\Repositories\Backend\Auth\PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @param \App\Repositories\Backend\Auth\RoleRepository $roleRepository
     * @param \App\Repositories\Backend\Auth\PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        View::share('js', ['users', 'roles']);
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\Role\ManageRoleRequest $request
     *
     * @return mixed
     */
    public function index(ManageRoleRequest $request)
    {
        return new ViewResponse('backend.auth.roles.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\Role\ManageRoleRequest $request
     *
     * @return \App\Http\Responses\Backend\Auth\Role\CreateResponse
     */
    public function create(ManageRoleRequest $request)
    {
        return new CreateResponse($this->permissionRepository, $this->roleRepository);
    }

    /**
     * @param  \App\Http\Requests\Backend\Auth\Role\StoreRoleRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roleRepository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.auth.role.index'), ['flash_success' => __('alerts.backend.access.roles.created')]);
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\Role\ManageRoleRequest $request
     * @param \App\Models\Auth\Role $role
     *
     * @return \App\Http\Responses\Backend\Auth\Role\EditResponse
     */
    public function edit(Role $role, EditRoleRequest $request)
    {
        return new EditResponse($role, $this->permissionRepository);
    }

    /**
     * @param  \App\Http\Requests\Backend\Auth\RoleUpdateRoleRequest  $request
     * @param  \App\Models\Auth\Role  $role
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->roleRepository->update($role, $request->except(['_token', '_method']));

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('alerts.backend.access.roles.updated'));
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\Role\ManageRoleRequest $request
     * @param \App\Models\Auth\Role $role
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageRoleRequest $request, Role $role)
    {
        $this->roleRepository->delete($role);

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('alerts.backend.access.roles.deleted'));
    }
}
