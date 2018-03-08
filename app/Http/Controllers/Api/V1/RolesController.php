<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\RoleResource;
use App\Models\Access\Role\Role;
use App\Repositories\Backend\Access\Role\RoleRepository;
use Illuminate\Http\Request;
use Validator;


class RolesController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(RoleRepository $repository)
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

        return RoleResource::collection(
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
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * Creates the Resourse for Role
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->valiatingRequest($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->create($request->all());

        
        return new RoleResource(Role::orderBy('created_at', 'desc')->first());
    }


    /**
     * @param Role              $role
     * @param UpdateRoleRequest $request
     *
     * @return mixed
     */
    public function update(Request $request, Role $role)
    {
      
        $validation = $this->valiatingRequest($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($role, $request->all());

        $role= Role::findOrfail($role->id);

        return new RoleResource($role);
    }

    public function valiatingRequest(Request $request)
    {
        $permissions = '';

        if ($request->post("associated_permissions") != 'all') {
            $permissions = 'required';
        }

        $validation = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'permissions' => $permissions,
        ]);

        return $validation;
    }
    /**
     * @param Role              $role
     * @param DeleteRoleRequest $request
     *
     * @return mixed
     */
    public function destroy(Role $role, Request $request)
    {
        $this->repository->delete($role);

        return ["message"=>"success"];
    }
}
