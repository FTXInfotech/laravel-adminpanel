<?php

namespace App\Http\Controllers\Api\V1;

use JWTAuth;
use Validator;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use App\Notifications\Activated;
use App\Notifications\Activation;
use App\Notifications\PasswordReset;
use App\Notifications\PasswordResetted;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * AuthController.
 */
class AuthController extends APIController
{
    /**
     * Authenticate User
     *
     * @param  Request $request
     * @return {mix}
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

        return response()->json(['message' => 'You are successfully logged in!', 'token' => $token]);
    }

    public function check()
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response(['authenticated' => false]);
        }

        return response(['authenticated' => true]);
    }

    public function logout()
    {
        try {
            $token = JWTAuth::getToken();

            if ($token) {
                JWTAuth::invalidate($token);
            }
        } catch (JWTException $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json(['message' => 'You are successfully logged out!']);
    }

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
            return response()->json(['message' => $validation->messages()->first()], 422);
        }

        $user = User::create([
            'email'    => request('email'),
            'status'   => 'pending_activation',
            'password' => bcrypt(request('password')),
        ]);

        $user->activation_token = generateUuid();
        $user->save();
       /* $profile = new Profile();
        $profile->first_name = request('first_name');
        $profile->last_name = request('last_name');
        $user->profile()->save($profile);*/

        $user->notify(new Activation($user));

        return response()->json(['message' => 'You have registered successfully. Please check your email for activation!']);
    }

    public function activate($activation_token)
    {
        $user = User::whereActivationToken($activation_token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid activation token!'], 422);
        }

        if ($user->status == 'activated') {
            return response()->json(['message' => 'Your account has already been activated!'], 422);
        }

        if ($user->status != 'pending_activation') {
            return response()->json(['message' => 'Invalid activation token!'], 422);
        }

        $user->status = 'activated';
        $user->save();
        $user->notify(new Activated($user));

        return response()->json(['message' => 'Your account has been activated!']);
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
