<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\User\DeleteUserRequest;
use App\Http\Requests\Backend\Access\User\EditUserRequest;
use App\Http\Requests\Backend\Access\User\ManageDeactivatedRequest;
use App\Http\Requests\Backend\Access\User\ManageDeletedRequest;
use App\Models\Access\User\User;
use App\Repositories\Backend\Access\User\UserRepository;

/**
 * Class UserStatusController.
 */
class UserStatusController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param ManageDeactivatedRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ManageDeactivatedRequest $request)
    {
        return view('backend.access.users.deactivated');
    }

    /**
     * @param ManageDeletedRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageDeletedRequest $request)
    {
        return view('backend.access.users.deleted');
    }

    /**
     * @param User $user
     * @param $status
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function mark(User $user, $status, EditUserRequest $request)
    {
        $this->users->mark($user, $status);

        return redirect()->route($status == 1 ? 'admin.access.user.index' : 'admin.access.user.deactivated')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    /**
     * @param User              $deletedUser
     * @param DeleteUserRequest $request
     *
     * @return mixed
     */
    public function delete(User $deletedUser, DeleteUserRequest $request)
    {
        $this->users->forceDelete($deletedUser);

        return redirect()->route('admin.access.user.deleted')->withFlashSuccess(trans('alerts.backend.users.deleted_permanently'));
    }

    /**
     * @param User              $deletedUser
     * @param DeleteUserRequest $request
     *
     * @return mixed
     */
    public function restore(User $deletedUser, DeleteUserRequest $request)
    {
        $this->users->restore($deletedUser);

        return redirect()->route('admin.access.user.index')->withFlashSuccess(trans('alerts.backend.users.restored'));
    }
}
