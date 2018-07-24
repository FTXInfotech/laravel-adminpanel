<?php

namespace App\Http\Responses\Backend\Access\Role;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
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
     * @param \App\Repositories\Backend\Access\Permission\PermissionRepository $permissions
     * @param \App\Repositories\Backend\Access\Role\RoleRepository             $roles
     */
    public function __construct($permissions, $roles)
    {
        $this->permissions = $permissions;
        $this->roles = $roles;
    }

    /**
     * In Response.
     *
     * @param \App\Http\Requests\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.access.roles.create')
            ->withPermissions($this->permissions->getAll())
            ->withRoleCount($this->roles->getCount());
    }
}
