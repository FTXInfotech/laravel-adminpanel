<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Frontend\Access\User\UserRepository;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Validator;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends APIController
{
    /**
     * User Repository
     * @var obj
     */
    protected $user;

    /**
     * Rest Password Constructor
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    /**
     * Reset Password
     * @param  Request
     * @param  JWTAuth
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request, JWTAuth $JWTAuth)
    {

        $validation = Validator::make($request->all(), [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:4|confirmed|regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        dd('viral');

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        if($response !== Password::PASSWORD_RESET) {
            throw new HttpException(500);
        }

        if(!Config::get('boilerplate.reset_password.release_token')) {
            return response()->json([
                'status' => 'ok',
            ]);
        }

        $user = User::where('email', '=', $request->get('email'))->first();

        return response()->json([
            'status' => 'ok',
            'token' => $JWTAuth->fromUser($user)
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
     * @param  $request
     * @return array
     */
    protected function credentials($request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = $password;
        $user->save();
    }
}
