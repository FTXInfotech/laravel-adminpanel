<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Repositories\Frontend\Access\User\UserRepository;
use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;


class ForgotPasswordController extends APIController
{
    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $user = $this->repository->findByEmail($request->get('email'));

        if (!$user) {
            return $this->respondNotFound(trans('api.messages.forgot_password.validation.email_not_found'));
        }

        $token = $this->repository->createNewToken();

        $user->notify(new UserNeedsPasswordReset($token));

        return $this->respond([
            'status'    => 'ok',
            'message'   => trans('api.messages.forgot_password.success'),
        ]);
    }
}
