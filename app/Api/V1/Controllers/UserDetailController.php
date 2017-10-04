<?php
namespace App\Api\V1\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\http\Controllers\Controller;
use JWTAuth;
use Dingo\Api\Routing\Helpers;
use App\Repositories\Api\User\UserRepository;


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
        $user=$this->user->getById($currentUser->id);
        return response()
                    ->json([
	                'status' => 'ok',
	                'data' => $user
                    ]);
    }
}


    

