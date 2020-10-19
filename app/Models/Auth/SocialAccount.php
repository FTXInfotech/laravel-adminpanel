<?php

namespace App\Models\Auth;

use App\Models\RecordableModel;

class SocialAccount extends RecordableModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'token',
        'avatar',
    ];
}
