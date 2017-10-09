<?php

namespace App\Api\V1\Controllers;

use App\http\Controllers\Controller;
use App\Repositories\Api\User\UserRepository;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use JWTAuth;

/**
 * Class UserDetailController.
 */
class UserDetailController extends Controller
{
    use Helpers;
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ResetPasswordController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /*
    * User details api
    */
    public function userDetails(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        $user = $this->user->getById($currentUser->id);

        return response()
                    ->json([
                    'status' => 'ok',
                    'data'   => $user,
                    ]);
    }
}
