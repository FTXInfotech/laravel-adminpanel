<?php

namespace App\Http\Controllers\Backend\Auth\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\Permission\CreatePermissionRequest;
use App\Http\Requests\Backend\Auth\Permission\DeletePermissionRequest;
use App\Http\Requests\Backend\Auth\Permission\EditPermissionRequest;
use App\Http\Requests\Backend\Auth\Permission\ManagePermissionRequest;
use App\Http\Requests\Backend\Auth\Permission\StorePermissionRequest;
use App\Http\Requests\Backend\Auth\Permission\UpdatePermissionRequest;
use App\Http\Responses\Backend\Auth\Permission\CreateResponse;
use App\Http\Responses\Backend\Auth\Permission\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Auth\Permission;
use App\Repositories\Backend\Auth\PermissionRepository;
use Illuminate\Support\Facades\View;

class PermissionsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Auth\PermissionRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\Auth\PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['permissions']);
    }

    /**
     * @param ManagePermissionRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManagePermissionRequest $request)
    {
        return new ViewResponse('backend.auth.permissions.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\Permission\CreatePermissionRequest $request
     *
     * @return \App\Http\Responses\Backend\Auth\Permission\CreateResponse
     */
    public function create(CreatePermissionRequest $request)
    {
        return new CreateResponse($this->repository);
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\Permission\StorePermissionRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StorePermissionRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.auth.permission.index'), ['flash_success' => __('alerts.backend.access.permissions.created')]);
    }

    /**
     * @param \App\Models\Auth\Permission $permission
     * @param \App\Http\Requests\Backend\Auth\Permission\EditPermissionRequest $request
     *
     * @return \App\Http\Responses\Backend\Auth\Permission\EditResponse
     */
    public function edit(Permission $permission, EditPermissionRequest $request)
    {
        return new EditResponse($permission);
    }

    /**
     * @param App\Models\Auth\Permission $permission
     * @param \App\Http\Requests\Backend\Auth\Permission\UpdatePermissionRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Permission $permission, UpdatePermissionRequest $request)
    {
        $this->repository->update($permission, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.auth.permission.index'), ['flash_success' => __('alerts.backend.access.permissions.updated')]);
    }

    /**
     * @param App\Models\Auth\Permission $permission
     * @param \App\Http\Requests\Backend\Auth\Permission\DeletePermissionRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Permission $permission, DeletePermissionRequest $request)
    {
        $this->repository->delete($permission);

        return new RedirectResponse(route('admin.auth.permission.index'), ['flash_success' => __('alerts.backend.access.permissions.deleted')]);
    }
}
