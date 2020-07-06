<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Models\Auth\SocialAccount;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\User\SocialRepository;

/**
 * Class UserSocialController.
 */
class UserSocialController extends Controller
{
    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     * @param \App\Repositories\Backend\Auth\User\SocialRepository  $socialRepository
     * @param \App\Models\Auth\User $user
     * @param \App\Models\Auth\SocialAccount $social
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function unlink(ManageUserRequest $request, SocialRepository $socialRepository, User $user, SocialAccount $social)
    {
        $socialRepository->delete($user, $social);

        return redirect()->back()->withFlashSuccess(__('alerts.backend.access.users.social_deleted'));
    }
}
