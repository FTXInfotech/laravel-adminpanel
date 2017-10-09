<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\ConfirmAccountRequest;
use App\Api\V1\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Api\User\UserRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /*
    * Register api.
    */
    public function Register(RegisterRequest $request)
    {
        $user = $this->user->create($request->all());

        return response()
                    ->json([
                    'status' => 'ok',
                    ]);
    }

    /*
    * Confirm account api
    */
    public function confirmAccount(ConfirmAccountRequest $request)
    {
        $user = $this->user->checkUser($request->get('email'));
        if (!(empty($user))) {
            if ($user[0]['confirmation_code'] != '') {
                if (md5($request->get('otp')) == $user[0]['confirmation_code']) {
                    $checkconfirmation = $this->user->checkconfirmation($request->get('email'));
                    if ($checkconfirmation[0]['confirmed'] == 0) {
                        $confirmuser = $this->user->confirmUser($request->get('email'));
                    } else {
                        throw new HttpException(500, trans('validation.api.confirmaccount.already_confirmed'));
                    }
                } else {
                    throw new HttpException(500, trans('validation.api.confirmaccount.invalid_otp'));
                }
            }
        } else {
            throw new HttpException(500, trans('validation.api.confirmaccount.invalid_email'));
        }

        return response()
                ->json([
                'status' => 'ok',
                ]);
    }
}
