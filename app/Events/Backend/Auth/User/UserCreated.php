<?php

namespace App\Events\Backend\Auth\User;

use App\Models\Auth\User;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserCreated.
 */
class UserCreated
{
    use SerializesModels;

    /**
     * @var \App\Models\Auth\User
     */
    public $user;

    /**
     * @param \App\Models\Auth\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
