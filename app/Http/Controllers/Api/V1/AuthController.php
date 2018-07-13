<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Access\User\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

class AuthController extends APIController
{
    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|min:4',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $credentials = $request->only(['email', 'password']);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->throwValidation(trans('api.messages.login.failed'));
            }
        } catch (JWTException $e) {
            return $this->respondInternalError($e->getMessage());
        }

        return $this->respond([
            'message'   => trans('api.messages.login.success'),
            'token'     => $token,
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            $token = JWTAuth::getToken();

            if ($token) {
                JWTAuth::invalidate($token);
            }
        } catch (JWTException $e) {
            return $this->respondInternalError($e->getMessage());
        }

        return $this->respond([
            'message'   => trans('api.messages.logout.success'),
        ]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = JWTAuth::getToken();

        if (!$token) {
            $this->respondUnauthorized(trans('api.messages.refresh.token.not_provided'));
        }

        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            return $this->respondInternalError($e->getMessage());
        }

        return $this->respond([
            'status' => trans('api.messages.refresh.status'),
            'token'  => $refreshedToken,
        ]);
    }
}
