<?php

namespace App\Models\Access\PasswordReset;

use App\Models\BaseModel;

/**
 * Password reset table model.
 */
class PasswordReset extends BaseModel
{
    public $timestamps = false;
    protected $table = 'password_resets';
    protected $fillable = [
                            'email',
                            'token',
                            '',
                ];
}
