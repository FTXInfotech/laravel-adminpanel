<?php

namespace App\Models\Access\User\Traits\Relationship;

use App\Models\Access\User\SocialLogin;
use App\Models\System\Session;

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
     * ONLY GETS PERMISSIONS ARE NOT ASSOCIATED WITH A ROLE.
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
}
