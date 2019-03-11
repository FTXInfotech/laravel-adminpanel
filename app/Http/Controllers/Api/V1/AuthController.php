<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Access\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $credentials = $request->only(['email', 'password']);

        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return $this->throwValidation(trans('api.messages.login.failed'));
            }
        } catch (JWTException $e) {
            return $this->respondInternalError($e->getMessage());
        }

        return $token;
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $token;
        return response()->json([
            'access_token' => $token,
            // 'token_type' => 'bearer',
            // 'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }

    /*
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function logout()
    // {
    //     try {
    //         $token = JWTAuth::getToken();

    //         if ($token) {
    //             JWTAuth::invalidate($token);
    //         }
    //     } catch (JWTException $e) {
    //         return $this->respondInternalError($e->getMessage());
    //     }

    //     return $this->respond([
    //         'message' => trans('api.messages.logout.success'),
    //     ]);
    // }

    /*
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     $token = JWTAuth::getToken();

    //     if (!$token) {
    //         $this->respondUnauthorized(trans('api.messages.refresh.token.not_provided'));
    //     }

    //     try {
    //         $refreshedToken = JWTAuth::refresh($token);
    //     } catch (JWTException $e) {
    //         return $this->respondInternalError($e->getMessage());
    //     }

    //     return $this->respond([
    //         'status' => trans('api.messages.refresh.status'),
    //         'token' => $refreshedToken,
    //     ]);
    // }
}
