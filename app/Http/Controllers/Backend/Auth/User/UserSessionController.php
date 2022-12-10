<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Models\Auth\User;

/**
 * Class UserSessionController.
 */
class UserSessionController extends Controller
{
    /**
     * @param  \App\Http\Requests\Backend\Auth\User\ManageUserRequest  $request
     * @param  \App\Models\Auth\User  $user
     * @return mixed
     */
    public function clearSession(ManageUserRequest $request, User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.users.cant_delete_own_session'));
        }

        $user->update(['to_be_logged_out' => true]);

        return redirect()->back()->withFlashSuccess(__('alerts.backend.access.users.session_cleared'));
    }
}
