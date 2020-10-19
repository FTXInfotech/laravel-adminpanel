<?php

namespace App\Http\Controllers\Backend\Auth\User;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;

/**
 * Class UserTableController.
 */
class UserTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Auth\UserRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\Auth\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Auth\User\ManageUserRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageUserRequest $request)
    {
        return Datatables::make($this->repository->getForDataTable($request->get('status'), $request->get('trashed')))
            ->escapeColumns(['first_name', 'email'])
            ->editColumn('confirmed', function ($user) {
                return $user->confirmed_label;
            })
            ->addColumn('roles', function ($user) {
                return $user->roles_label;
            })
            ->addColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($user) {
                return Carbon::parse($user->updated_at)->toDateString();
            })
            ->addColumn('actions', function ($user) {
                return $user->action_buttons;
            })
            ->make(true);
    }
}
