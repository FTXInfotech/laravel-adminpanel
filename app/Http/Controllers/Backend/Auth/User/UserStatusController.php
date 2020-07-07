<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\UserRepository;
use Illuminate\Support\Facades\View;

/**
 * Class UserStatusController.
 */
class UserStatusController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Auth\UserRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\Auth\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['users']);
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ManageUserRequest $request)
    {
        return view('backend.auth.user.deactivated')
            ->withUsers($this->repository->getInactivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageUserRequest $request)
    {
        return view('backend.auth.user.deleted');
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     * @param \App\Models\Auth\User $user
     * @param int $status
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function mark(ManageUserRequest $request, User $user, $status)
    {
        $this->repository->mark($user, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
                'admin.auth.user.index' :
                'admin.auth.user.deactivated'
        )->withFlashSuccess(__('alerts.backend.access.users.updated'));
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     * @param \App\Models\Auth\User $deletedUser
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete(ManageUserRequest $request, User $deletedUser)
    {
        $this->repository->forceDelete($deletedUser);

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.access.users.deleted_permanently'));
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     * @param \App\Models\Auth\User $deletedUser
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageUserRequest $request, User $deletedUser)
    {
        $this->repository->restore($deletedUser);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.access.users.restored'));
    }
}
