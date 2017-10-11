<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\ForgotPasswordRequest;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Repositories\Api\User\PasswordResetRepository;
use App\Repositories\Api\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class ForgotPasswordController.
 */
class ForgotPasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ForgotPasswordController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, PasswordResetRepository $passwordreset)
    {
        $this->user = $user;
        $this->passwordreset = $passwordreset;
    }

    /**
     * Recovery password api.
     */
    public function forgotpassword(ForgotPasswordRequest $request)
    {
        $check_user = $this->user->checkUser($request->get('email'));
        if (!(empty($check_user))) {
            $otp = $this->user->generateOTP();
            $attributes = [
                    'email'      => $request->get('email'),
                    'token'      => $otp,
                    'created_at' => Carbon::now(),
            ];
            $check_reset = $this->passwordreset->getByEmail($request->get('email'));
            if (empty($check_reset)) {
                $token = $this->passwordreset->create($attributes);
            } else {
                $token = $this->passwordreset->update($attributes);
            }
            $forgot_mail = \Mail::to($request->get('email'))->send(new ForgotPasswordMail($otp));

            return response()->json([
                               'status' => 'ok',
                               'data'   => ['token' => $otp],
            ], 200);
        }

        throw new HttpException(500, trans('validation.api.forgotpassword.email_not_valid'));
    }
}
