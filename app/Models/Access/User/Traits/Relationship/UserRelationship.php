<?php

namespace App\Models\Access\User\Traits\Relationship;

use App\Models\System\Session;
use App\Models\Access\User\SocialLogin;
use App\Models\States\State;
use App\Models\Cities\City;
use App\Models\Countries\Country;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.role_user_table'), 'user_id', 'role_id');
    }

    /**
     * Many-to-Many relations with Permission.
     * ONLY GETS PERMISSIONS ARE NOT ASSOCIATED WITH A ROLE
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(config('access.permission'), config('access.permission_user_table'), 'user_id', 'permission_id');
    }

    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialLogin::class);
    }

    /**
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    /**
     * Has-One relationship with state
     * @return mixed
     */
    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }    

    /**
     * Has-One relationship with cty
     * @return mixed
     */
    public function city()
    {
        return $this->hasOne(City::class,'id', 'city_id');
    }
    /**
     * Has-One relationship with country
     * @return mixed
     */
    public function country()
    {
        return $this->hasOne(Country::class,'id', 'country_id');
    }
}
