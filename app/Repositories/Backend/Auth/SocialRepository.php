<?php

namespace App\Repositories\Backend\Auth\User;

use App\Models\Auth\User;
use App\Models\Auth\SocialAccount;
use App\Exceptions\GeneralException;
use App\Events\Backend\Auth\User\UserSocialDeleted;

class SocialRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = SocialAccount::class;

    /**
     * @param \App\Models\Auth\User $user
     * @param App\Models\Auth\SocialAccount $social
     *
     * @throws GeneralException
     * @return bool
     */
    public function delete(User $user, SocialAccount $social)
    {
        if ($user->providers()->whereId($social->id)->delete()) {
            event(new UserSocialDeleted($user, $social));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.access.users.social_delete_error'));
    }
}
