<?php

namespace App\Http\Responses\Backend\Auth\Role;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Auth\Role
     */
    protected $role;

    /**
     * @var \App\Repositories\Backend\Auth\Permission\PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @param \App\Models\Auth\Role $role
     * @param \App\Repositories\Backend\Auth\Permission\PermissionRepository $permissionRepository
     */
    public function __construct($role, $permissionRepository)
    {
        $this->role = $role;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.auth.roles.edit')
            ->withRole($this->role)
            ->withRolePermissions($this->role->permissions->pluck('id')->all())
            ->withPermissions($this->permissionRepository->getAll());
    }
}
