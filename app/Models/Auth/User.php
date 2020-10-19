<?php

namespace App\Models\Auth;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\Auth\Traits\Access\UserAccess;
use App\Models\Auth\Traits\Scopes\UserScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Traits\Methods\UserMethods;
use App\Models\Auth\Traits\Attributes\UserAttributes;
use App\Models\Auth\Traits\Relationships\UserRelationships;

/**
 * Class User.
 */
class User extends BaseUser
{
    use HasApiTokens, Notifiable, SoftDeletes, UserAttributes, UserScopes, UserAccess, UserRelationships, UserMethods;
}
