<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\LoginRequest;
use App\http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class LoginController.
 */
class LoginController extends Controller
{
    /*
    * Login api for user
    */
    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        try {
            /**
             * check credentials valid or not.
             */
            $token = $JWTAuth->attempt($credentials);
            if (!$token) {
                throw new AccessDeniedHttpException(trans('validation.api.login.username_password_didnt_match'));
            }
        } catch (JWTException $e) {
            throw new HttpException(500);
        }

        return response()
                    ->json([
                    'status' => 'ok',
                    'token'  => $token,
                    ]);
    }
}
