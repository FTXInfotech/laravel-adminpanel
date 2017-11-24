<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\User\CreateUserRequest;
use App\Http\Requests\Backend\Access\User\DeleteUserRequest;
use App\Http\Requests\Backend\Access\User\EditUserRequest;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Http\Requests\Backend\Access\User\ShowUserRequest;
use App\Http\Requests\Backend\Access\User\StoreUserRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserRequest;
use App\Models\Access\User\User;
use App\Repositories\Backend\Access\Role\RoleRepository;
use App\Repositories\Backend\Access\User\UserRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * @param UserRepository $users
     * @param RoleRepository $roles
     */
    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageUserRequest $request)
    {
        return view('backend.access.index');
    }

    /**
     * @param CreateUserRequest $request
     *
     * @return mixed
     */
    public function create(CreateUserRequest $request)
    {
        return view('backend.access.create')->with([
            'roles' => $this->roles->getAll(),
        ]);
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $this->users->create($request);

        return redirect()->route('admin.access.user.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    /**
     * @param User            $user
     * @param ShowUserRequest $request
     *
     * @return mixed
     */
    public function show(User $user, ShowUserRequest $request)
    {
        return view('backend.access.show')
            ->withUser($user);
    }

    /**
     * @param User            $user
     * @param EditUserRequest $request
     *
     * @return mixed
     */
    public function edit(User $user, EditUserRequest $request)
    {
        //@todo move queries in to repositery
        $userPermissions = DB::table('permission_user')->where('user_id', $user->id)->pluck('permission_id', 'permission_id')->toArray();
        $permissions = DB::table('permissions')->pluck('display_name', 'id')->toArray();
        ksort($userPermissions);
        ksort($permissions);

        /*return view('backend.access.edit')->with([
            'user'              => $user,
            'userRoles'         => $user->roles->pluck('id')->all(),
            'roles'             => $this->roles->getAll(),
            'userPermissions'   => $userPermissions,
            'permissions'       => $permissions
        ]);*/

        return view('backend.access.edit', compact('userPermissions', 'permissions'))
            ->withUser($user)
            ->withUserRoles($user->roles->pluck('id')->all())
            ->withRoles($this->roles->getAll());
    }

    /**
     * @param User              $user
     * @param UpdateUserRequest $request
     *
     * @return mixed
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $this->users->update($user, ['data' => $request->except('assignees_roles'), 'roles' => $request->all('assignees_roles')]);

        return redirect()->route('admin.access.user.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    /**
     * @param User              $user
     * @param DeleteUserRequest $request
     *
     * @return mixed
     */
    public function destroy(User $user, DeleteUserRequest $request)
    {
        $this->users->delete($user);

        return redirect()->route('admin.access.user.deleted')->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }
}
