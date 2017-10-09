<?php

namespace App\Models\Access\PasswordReset;

use Illuminate\Database\Eloquent\Model;

/**
 * Password reset table model.
 */
class PasswordReset extends Model
{
    public $timestamps = false;
    protected $table = 'password_resets';
    protected $fillable = [
                            'email',
                            'token',
                            '',
                ];
}
