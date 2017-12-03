<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends APIController
{
    /**
     * Reset Password.
     *
     * @param  ResetPasswordRequest
     * @param  JWTAuth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request, JWTAuth $JWTAuth)
    {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->reset($user, $password);
            }
        );

        if ($response !== Password::PASSWORD_RESET) {
            throw new HttpException(500);
        }

        if (!Config::get('boilerplate.reset_password.release_token')) {
            return response()->json([
                'status' => 'ok',
            ]);
        }

        $user = User::where('email', '=', $request->get('email'))->first();

        return response()->json([
            'status' => 'ok',
            'token'  => $JWTAuth->fromUser($user),
        ]);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param ResetPasswordRequest $request
     *
     * @return array
     */
    protected function credentials(ResetPasswordRequest $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param string                                      $password
     *
     * @return void
     */
    protected function reset($user, $password)
    {
        $user->password = $password;
        $user->save();
    }
}
