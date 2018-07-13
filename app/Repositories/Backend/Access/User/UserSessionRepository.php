<?php

namespace App\Repositories\Backend\Access\User;

use App\Exceptions\GeneralException;
use App\Models\Access\User\User;

/**
 * Class UserSessionRepository.
 */
class UserSessionRepository
{
    /**
     * @param User $user
     *
     * @throws GeneralException
     *
     * @return mixed
     */
    public function clearSession(User $user)
    {
        if ($user->id === access()->id()) {
            throw new GeneralException(trans('exceptions.backend.access.users.cant_delete_own_session'));
        }
        if (config('session.driver') != 'database') {
            throw new GeneralException(trans('exceptions.backend.access.users.session_wrong_driver'));
        }

        return $user->sessions()->delete();
    }
}
