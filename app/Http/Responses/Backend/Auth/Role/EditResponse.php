<?php

namespace App\Http\Responses\Backend\Auth\Role;

use App\Models\Auth\Permission\Permission;
use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Auth\Role\Role
     */
    protected $role;

    /**
     * @var \App\Repositories\Backend\Auth\Permission\PermissionRepository
     */
    protected $permissions;

    /**
     * @param \App\Models\Auth\Role\Role                                     $role
     * @param \App\Repositories\Backend\Auth\Permission\PermissionRepository $permissions
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
        return view('backend.auth.roles.edit')
            ->withRole($this->role)
            ->withRolePermissions($this->role->permissions->pluck('id')->all())
            ->withPermissions($this->permissions->getAll());
    }
}
