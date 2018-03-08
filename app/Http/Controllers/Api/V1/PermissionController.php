<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\PermissionResource;
use App\Models\Access\Permission\Permission;
use App\Repositories\Backend\Access\Permission\PermissionRepository;
use Illuminate\Http\Request;
use Validator;

class PermissionController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;

        return PermissionResource::collection(
            $this->repository->getPaginated($limit)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return new PermissionResource($permission);
    }

    /**
     * Creates the Resource for Role.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validatingRequest($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        $this->repository->create($request->all());

        $permission = Permission::orderBy('created_at', 'desc')->first();

        return new PermissionResource($permission);
    }

    /**
     * @param Role              $role
     * @param UpdateRoleRequest $request
     *
     * @return mixed
     */
    public function update(Request $request, Permission $permission)
    {
        $validation = $this->validatingRequest($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($permission, $request->all());

        $permission = Permission::findOrfail($permission->id);

        return new PermissionResource($permission);
    }

    public function validatingRequest(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'         => 'required|max:191',
            'display_name' => 'required|max:191',
        ]);

        return $validation;
    }

    /**
     * @param Role              $role
     * @param DeleteRoleRequest $request
     *
     * @return mixed
     */
    public function destroy(Permission $permission, Request $request)
    {
        $this->repository->delete($permission);

        return ['message'=>'success'];
    }
}
