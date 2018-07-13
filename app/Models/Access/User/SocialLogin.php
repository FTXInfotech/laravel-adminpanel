<?php

namespace App\Models\Access\User;

use App\Models\BaseModel;

/**
 * Class SocialLogin.
 */
class SocialLogin extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social_logins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'provider', 'provider_id', 'token', 'avatar'];
}
