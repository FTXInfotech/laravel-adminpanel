<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Access\User\User;
use App\Notifications\Activated;
use App\Notifications\Activation;
use App\Notifications\PasswordReset;
use App\Notifications\PasswordResetted;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

/**
 * AuthController.
 */
class AuthController extends APIController
{
    /**
     * Authenticate User.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->throwValidation('Invalid Credentials! Please try again.');
            }
        } catch (JWTException $e) {
            return $this->respondInternalError('This is something wrong. Please try again!');
        }

        $user = User::whereEmail(request('email'))->first();

        if ($user->status != 1) {
            return $this->throwValidation('Your account hasn\'t been activated. Please check your email & activate account.');
        }

        return $this->respond([
            'message'   => 'You are successfully logged in!',
            'token'     => $token,
        ]);
    }

    /**
     * Check if user is authenticated or not.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function check()
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return $this->respond([
                'authenticated'  => false,
            ]);
        }

        return $this->respond([
            'authenticated'  => true,
        ]);
    }

    /**
     * Log Out.
     *
     *  @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            $token = JWTAuth::getToken();

            if ($token) {
                JWTAuth::invalidate($token);
            }
        } catch (JWTException $e) {
            return $this->respondInternalError('This is something wrong. Please try again!');
        }

        return $this->respond([
            'message'   => 'You are successfully logged out!',
        ]);
    }

    /**
     * Register User.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $user = User::create([
            'first_name'    => request('first_name'),
            'last_name'     => request('last_name'),
            'email'         => request('email'),
            'status'        => '0',
            'password'      => bcrypt(request('password')),
            'country_id'    => 1,
            'state_id'      => 1,
            'city_id'       => 1,
            'zip_code'      => 1,
            'ssn'           => 123456789,
            'created_by'    => 1,
        ]);

        $user->confirmation_code = generateUuid();
        $user->save();

        $user->notify(new Activation($user));

        return $this->respondCreated([
           'You have registered successfully. Please check your email for activation!',
        ]);
    }

    /**
     * Activate User.
     *
     * @param  $activation_token [description]
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate($activation_token)
    {
        $user = User::whereConfirmationCode($activation_token)->first();

        if (!$user) {
            return $this->throwValidation('Invalid activation token!');
        }

        if ($user->status == 1) {
            return $this->throwValidation('Your account has already been activated!');
        }

        $user->confirmed = 1;
        $user->status = 1;
        $user->save();
        $user->notify(new Activated($user));

        return $this->respond([
            'message'  => 'Your account has been activated!',
        ]);
    }

    public function password(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return response()->json(['message' => $validation->messages()->first()], 422);
        }

        $user = User::whereEmail(request('email'))->first();

        if (!$user) {
            return response()->json(['message' => 'We couldn\'t found any user with this email. Please try again!'], 422);
        }

        $token = generateUuid();
        \DB::table('password_resets')->insert([
            'email' => request('email'),
            'token' => $token,
        ]);
        $user->notify(new PasswordReset($user, $token));

        return response()->json(['message' => 'We have sent reminder email. Please check your inbox!']);
    }

    public function validatePasswordReset(Request $request)
    {
        $validate_password_request = \DB::table('password_resets')->where('token', '=', request('token'))->first();

        if (!$validate_password_request) {
            return response()->json(['message' => 'Invalid password reset token!'], 422);
        }

        if (date('Y-m-d H:i:s', strtotime($validate_password_request->created_at.'+30 minutes')) < date('Y-m-d H:i:s')) {
            return response()->json(['message' => 'Password reset token is expired. Please request reset password again!'], 422);
        }

        return response()->json(['message' => '']);
    }

    public function reset(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validation->fails()) {
            return response()->json(['message' => $validation->messages()->first()], 422);
        }

        $user = User::whereEmail(request('email'))->first();

        if (!$user) {
            return response()->json(['message' => 'We couldn\'t found any user with this email. Please try again!'], 422);
        }

        $validate_password_request = \DB::table('password_resets')->where('email', '=', request('email'))->where('token', '=', request('token'))->first();

        if (!$validate_password_request) {
            return response()->json(['message' => 'Invalid password reset token!'], 422);
        }

        if (date('Y-m-d H:i:s', strtotime($validate_password_request->created_at.'+30 minutes')) < date('Y-m-d H:i:s')) {
            return response()->json(['message' => 'Password reset token is expired. Please request reset password again!'], 422);
        }

        $user->password = bcrypt(request('password'));
        $user->save();

        $user->notify(new PasswordResetted($user));

        return response()->json(['message' => 'Your password has been reset. Please login again!']);
    }

    public function changePassword(Request $request)
    {
        if (env('IS_DEMO')) {
            return response()->json(['message' => 'You are not allowed to perform this action in this mode.'], 422);
        }

        $validation = Validator::make($request->all(), [
            'current_password'          => 'required',
            'new_password'              => 'required|confirmed|different:current_password|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        if ($validation->fails()) {
            return response()->json(['message' => $validation->messages()->first()], 422);
        }

        $user = JWTAuth::parseToken()->authenticate();

        if (!\Hash::check(request('current_password'), $user->password)) {
            return response()->json(['message' => 'Old password does not match! Please try again!'], 422);
        }

        $user->password = bcrypt(request('new_password'));
        $user->save();

        return response()->json(['message' => 'Your password has been changed successfully!']);
    }
}
