<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities\City;
use App\Models\States\State;
use App\Models\Access\User\User;
use App\Models\Access\Role\Role;
use App\Models\Access\Permission\Permission;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    /**
     * Used to get the states of default country
     * 
     * @param Request $request
     * @return JSON
     */
    public function getStates(Request $request)
    {
        $states = State::where("country_id", config("access.constants.default_country"))->pluck('state', 'id')->toArray();

         return array(
                "status" => "state",
                "data" => $states
            );
    }

    /**
     * Used to get the cities of selected state
     * 
     * @param Request $request
     * @return JSON
     */
    public function getCities(Request $request)
    {
        $cities = City::where("state_id", $request->stateId)->pluck('city', 'id')->toArray();

         return array(
                "status" => "city",
                "data" => $cities
            );
    }

    /**
     * Used to display form for edit profile
     *
     * @return view
     */
    public function editProfile(Request $request)
    {
        return view("backend.access.profile-edit")
            ->withLoggedInUser(access()->user());
    }

    /**
     * Used to update profile
     *
     * @return view
     */
    public function updateProfile(Request $request)
    {
        $input = $request->all();
        $userId = access()->user()->id;
        $user = User::find($userId);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->address = $input['address'];
        $user->state_id = $input['state_id'];
        $user->country_id = config("access.constants.default_country");
        $user->city_id = $input['city_id'];
        $user->zip_code = $input['zip_code'];
        $user->ssn = $input['ssn'];
        $user->updated_by = access()->user()->id;

        if($user->save())
        {
            return redirect()->route('admin.profile.edit')
                ->withFlashSuccess(trans("labels.backend.profile_updated"));
        }
    }

    /**
     * This function is used to get permissions details by role
     *
     * @param Request $request
     */
    public function getPermissionByRole(Request $request)
    {
        if ($request->ajax()) {
            $role_id = $request->get('role_id');
            $rsRolePermissions = Role::where('id', $role_id)->first();
            $rolePermissions = $rsRolePermissions->permissions->pluck('display_name', 'id')->all();
            $permissions = Permission::pluck('display_name', 'id')->all();
            ksort($rolePermissions);
            ksort($permissions);
            $results['permissions'] = $permissions;
            $results['rolePermissions'] = $rolePermissions;
            $results['allPermissions'] = $rsRolePermissions->all;
            echo json_encode($results);
            die;
        }
    }
}
