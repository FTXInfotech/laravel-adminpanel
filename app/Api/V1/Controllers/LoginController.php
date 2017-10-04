<?php
namespace App\Api\V1\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use App\Api\V1\Requests\LoginRequest;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;

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
      	$credentials=array(
            'email' => $request->email,
            'password' => $request->password
        );
	try {
	/**
	* check credentials valid or not
	*/
        $token = $JWTAuth->attempt($credentials);
            if(!$token)
            {
                throw new AccessDeniedHttpException(trans('validation.api.login.username_password_didnt_match'));
            }
        }catch (JWTException $e) {
            throw new HttpException(500);
        }
       	return response()
                    ->json([
	                'status' => 'ok',
	                'token' => $token
                    ]);
    }
}


    