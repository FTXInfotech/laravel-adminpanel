<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserResource;
use App\Models\Access\User\User;
use App\Repositories\Backend\Access\User\UserRepository;
use Illuminate\Http\Request;
use Validator;

class UsersController extends APIController
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;

        return UserResource::collection(
            $this->repository->getForDataTable(1, false)->paginate($limit)
        );
    }

    /**
     * Return the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = new UserResource($user);
        $history['history'] = history()->renderEntity('User', $user->id);
        $maindata = $data->toArray($user);
        $maindata = array_merge($maindata, $history);

        return $maindata;
    }

    /**
     * Return the specified resource.
     *
     * @param Request 
     *
     * @return \Illuminate\Http\Response
     */
    public function deactivatedUserList(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        
        return UserResource::collection(
            $this->repository->getForDataTable(0,false)->paginate($limit)
        );
    }
    
    /**
     * Return the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUserList(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;
        return UserResource::collection(
            $this->repository->getForDataTable(0, true)->paginate($limit)
        );
    }
        
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validation = $this->valiatingRequest($request, 'edit', $user->id);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $this->repository->update($user, $request);

        $user = User::findOrfail($user->id);

        return new UserResource($user);
    }

    /**
     * Store the specified resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $this->valiatingRequest($request);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }
        $this->repository->create($request);

        return new UserResource(User::orderBy('created_at', 'desc')->first());
    }

    /**
     * Validation function to validate user input.
     */
    public function valiatingRequest(Request $request, $string = '', $id = 0)
    {
        $password = ($string == 'edit') ? '' : 'required|min:6|confirmed';
        $validation = Validator::make($request->all(), [
            'first_name'      => 'required|max:255',
            'last_name'       => 'required|max:255',
            'email'           => 'required|max:255|email|unique:users,email,'.$id,
            'password'        => $password,
            'assignees_roles' => 'required',
            'permissions'     => 'required',
        ]);

        return $validation;
    }

    /**
     * Api to delete the resource.
     *
     * @param Role              $role
     * @param DeleteRoleRequest $request
     *
     * @return mixed
     */
    public function destroy(User $user, Request $request)
    {
        $this->repository->delete($user);

        return ['message' => 'success'];
    }
}
