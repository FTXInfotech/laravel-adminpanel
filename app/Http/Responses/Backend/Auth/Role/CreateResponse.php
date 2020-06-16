<?php

namespace App\Http\Responses\Backend\Auth\Role;

use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    /**
     * @var \App\Repositories\Backend\Auth\Role\RoleRepository
     */
    protected $roles;

    /**
     * @var \App\Repositories\Backend\Auth\Permission\PermissionRepository
     */
    protected $permissions;

    /**
     * @param \App\Repositories\Backend\Auth\Permission\PermissionRepository $permissions
     * @param \App\Repositories\Backend\Auth\Role\RoleRepository             $roles
     */
    public function __construct($permissions, $roles)
    {
        $this->permissions  = $permissions;
        $this->roles        = $roles;
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
        return view('backend.auth.roles.create')
            ->withPermissions($this->permissions->all())
            ->withRoleCount($this->roles->count());
    }
}
