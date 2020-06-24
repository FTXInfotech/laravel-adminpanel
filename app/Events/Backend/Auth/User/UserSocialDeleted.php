<?php

namespace App\Events\Backend\Auth\User;

use App\Models\Auth\User;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserSocialDeleted.
 */
class UserSocialDeleted
{
    use SerializesModels;

    /**
     * @var \App\Models\Auth\User
     */
    public $user;

    /**
     * @var
     */
    public $social;

    /**
     * UserSocialDeleted constructor.
     *
     * @param \App\Models\Auth\User $user
     * @param $social
     */
    public function __construct(User $user, $social)
    {
        $this->user = $user;
        $this->social = $social;
    }
}
