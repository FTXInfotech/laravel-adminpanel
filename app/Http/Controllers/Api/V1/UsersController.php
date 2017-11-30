<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Repositories\Backend\Access\User\UserRepository;

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
            $this->repository->getPaginated($limit)
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
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validation = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'email|unique:users,email,'.$user->id,
            'password'  => 'nullable|confirmed',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $user = $this->repository->update($user->id, $request->all());

        return new UserResource($user);
    }
}
