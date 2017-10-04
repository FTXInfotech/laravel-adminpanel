<?php
namespace App\Api\V1\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repositories\Api\User\UserRepository;
use App\Repositories\Api\User\PasswordResetRepository;
use Illuminate\Support\Facades\Password;
use App\Api\V1\Requests\ResetPasswordRequest;

/**
 * Class ResetPasswordController.
 */
class ResetPasswordController extends Controller
{
    /**
    * @var UserRepository
    */
    protected $user;
    /**
    * ResetPasswordController constructor.
    *
    * @param UserRepository $user
    */
    public function __construct(UserRepository $user,PasswordResetRepository $passwordreset)
    {
        $this->user = $user;
  	$this->passwordreset=$passwordreset;
    }
    /**
    * Resetpassword api.
    */
    public function resetpassword(ResetPasswordRequest $request)
    {
        $check_user=$this->user->checkUser($request->get('email'));
        if(!(empty($check_user)))
        {
            $response = $this->passwordreset->checkUser($this->credentials($request));
            if(!(empty($response)))
            {
                $resetpassword=$this->user->resetpassword($this->credentials($request));
                $remove_token=$this->passwordreset->delete($this->credentials($request));
                return response()
                        ->json([
                            'status' => 'ok',
                        ]);
            }
            throw new HttpException(500,trans('validation.api.resetpassword.token_not_valid'));
        }
            throw new HttpException(500,trans('validation.api.resetpassword.email_not_valid'));
    }
    /**
     * Get the password reset credentials from the request.
     *
     * @param  ResetPasswordRequest  $request
     * @return array
     */
    protected function credentials(ResetPasswordRequest $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

}
