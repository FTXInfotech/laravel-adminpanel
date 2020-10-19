<?php

namespace App\Http\Responses\Backend\Auth\Permission;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Auth\Permission\Permission
     */
    protected $permission;

    /**
     * @param \App\Models\Auth\Permission\Permission $permission
     */
    public function __construct($permission)
    {
        $this->permission = $permission;
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
        return view('backend.auth.permissions.edit')
            ->withPermission($this->permission);
    }
}
