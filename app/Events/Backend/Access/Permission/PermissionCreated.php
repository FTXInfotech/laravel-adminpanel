<?php

namespace App\Events\Backend\Access\Permission;

use Illuminate\Queue\SerializesModels;

/**
 * Class PermissionCreated.
 */
class PermissionCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $permission;

    /**
     * @param $permission
     */
    public function __construct($permission)
    {
        $this->permission = $permission;
    }
}
