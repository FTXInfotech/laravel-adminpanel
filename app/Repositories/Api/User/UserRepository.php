<?php

namespace App\Repositories\Api\User;

use App\Mail\ConfirmAcoountMail;
use App\Models\Access\User\User;
use App\Repositories\Backend\Access\Role\RoleRepository;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;
    /**
     *   Protected rolerepository.
     */
    protected $role;

    /**
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    /**
     * Check given user is exist or not.
     *
     * @return mixed
     */
    public function checkUser($email)
    {
        return $this->query()->where('email', $email)->get()->toArray();
    }

    /**
     * Generate OTP when forgot password.
     *
     * @return mixed
     */
    public function generateOTP()
    {
        return mt_rand(100000, 999999);
    }

    /**
     * Reset password.
     *
     * @return mixed
     */
    public function resetpassword($data)
    {
        $pass = ['password' => bcrypt($data['password'])];

        return $this->query()->where('email', $data['email'])->update($pass);
    }

    /**
     * Get user details by  id.
     *
     * @return mixed
     */
    public function getById($id)
    {
        return $this->query()
                    ->select('first_name', 'last_name', 'email', 'address', 'country_id', 'state_id', 'city_id', 'zip_code', 'ssn', 'status', 'created_at', 'updated_at')
                    ->where('id', $id)
                    ->with(['country' => function ($query) {
                        $query->select('id', 'country');
                    }])
                    ->with(['state' => function ($query) {
                        $query->select('id', 'state');
                    }])
                    ->with(['city' => function ($query) {
                        $query->select('id', 'city');
                    }])
                    ->get()
                    ->toArray();
    }

    /**
     * Create user account.
     *
     * @param array $data
     * @param bool  $provider
     *
     * @return static
     */
    public function create(array $data, $provider = false)
    {
        $otp = $this->generateOTP();
        $user = self::MODEL;
        $user = new $user();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->address = $data['address'];
        $user->state_id = $data['state_id'];
        $user->country_id = config('access.constants.default_country');
        $user->city_id = $data['city_id'];
        $user->zip_code = $data['zip_code'];
        $user->ssn = $data['ssn'];
        $user->email = $data['email'];
        $user->confirmation_code = md5($otp);
        $user->status = 1;
        $user->password = $provider ? null : bcrypt($data['password']);
        $user->confirmed = $provider ? 1 : (config('access.users.confirm_email') ? 0 : 1);
        $user->created_by = 1;

        \DB::transaction(function () use ($user) {
            if ($user->save()) {
                /*
                 * Add the default site role to the new user
                 */
                $user->attachRole($this->role->getDefaultUserRole());
            }
        });
        /*
         * If users have to confirm their email and this is not a social account,
         * send the confirmation email
         *
         * If this is a social account they are confirmed through the social provider by default
         */
        if (config('access.users.confirm_email') && $provider === false) {
            $Confirmation_mail = \Mail::to($data['email'])->send(new ConfirmAcoountMail($otp));
        }

        /*
        * Return the user object
        */
        return $user;
    }

    /*
    * Check user is already confirmed or not
    */
    public function checkconfirmation($email)
    {
        return $this->query()->where('email', $email)->get()->toArray();
    }

    /**
     * Confirm user's account.
     **/
    public function confirmUser($email)
    {
        $confirmed = ['confirmed' => '1'];

        return $this->query()->where('email', $email)->update($confirmed);
    }
}
