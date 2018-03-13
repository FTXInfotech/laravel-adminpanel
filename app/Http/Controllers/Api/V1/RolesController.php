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
     * Return the roles.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;

        return RoleResource::collection(
            $this->repository->getForDataTable()->paginate($limit)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param Role $role
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * Creates the Resource for Role.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->validateRole($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation);
        }

        $this->repository->create($request->all());

        return new RoleResource(Role::orderBy('created_at', 'desc')->first());
    }

    /**
     * Update User.
     *
     * @param Request $request
     * @param Role    $role
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Role $role)
    {
        $validation = $this->validateRole($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation);
        }

        $this->repository->update($role, $request->all());

        $role = Role::findOrfail($role->id);

        return new RoleResource($role);
    }

    /**
     * @param Role    $role
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role, Request $request)
    {
        $this->repository->delete($role);

        return $this->respond([
            'message' => trans('alerts.backend.roles.deleted'),
        ]);
    }

    /**
     * validateUser Role Requests.
     *
     * @param $request
     *
     * @return Validator object
     */
    public function validateRole(Request $request)
    {
        $permissions = '';

        if ($request->post('associated_permissions') != 'all') {
            $permissions = 'required';
        }

        $validation = Validator::make($request->all(), [
            'name'        => 'required|max:191',
            'permissions' => $permissions,
        ]);

        return $validation;
    }
}
