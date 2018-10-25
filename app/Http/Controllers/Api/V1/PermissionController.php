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
     * Return the permissions.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        $orderBy = $request->get('orderBy') ? $request->get('orderBy') : 'ASC';
        $sortBy = $request->get('sortBy') ? $request->get('sortBy') : 'created_at';

        return PermissionResource::collection(
            $this->repository->getForDataTable()->orderBy($sortBy, $orderBy)->paginate($limit)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param Permission $permission
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Permission $permission)
    {
        return new PermissionResource($permission);
    }

    /**
     * Creates the Resource for Permission.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = $this->validatePermission($request);
        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        $this->repository->create($request->all());

        $permission = Permission::orderBy('created_at', 'desc')->first();

        return new PermissionResource($permission);
    }

    /**
     * @param Permission $permission
     * @param Request    $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Permission $permission)
    {
        $validation = $this->validatePermission($request, $permission->id);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($permission, $request->all());

        $permission = Permission::findOrfail($permission->id);

        return new PermissionResource($permission);
    }

    /**
     * Delete permission.
     *
     * @param Role              $role
     * @param DeleteRoleRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission, Request $request)
    {
        $this->repository->delete($permission);

        return $this->respond([
            'data'    => $permission->id,
            'message' => trans('alerts.backend.permissions.deleted'),
        ]);
    }

    /**
     * validateUser Permission Requests.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Validator object
     */
    public function validatePermission(Request $request, $id = 0)
    {
        $validation = Validator::make($request->all(), [
            'name'         => 'required|max:191|unique:permissions,name,'.$id,
            'display_name' => 'required|max:191',
        ]);

        return $validation;
    }
}
