<?php

namespace App\Http\Responses\Backend\Access\Role;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Access\Role\Role
     */
    protected $role;

    /**
     * @var \App\Repositories\Backend\Access\Permission\PermissionRepository
     */
    protected $permissions;

    /**
     * @param \App\Models\Access\Role\Role                                     $role
     * @param \App\Repositories\Backend\Access\Permission\PermissionRepository $permissions
     */
    public function __construct($role, $permissions)
    {
        $this->role = $role;
        $this->permissions = $permissions;
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
        return view('backend.access.roles.edit')
            ->withRole($this->role)
            ->withRolePermissions($this->role->permissions->pluck('id')->all())
            ->withPermissions($this->permissions->getAll());
    }
}
