<?php

namespace App\Events\Backend\Access\Permission;

use Illuminate\Queue\SerializesModels;

/**
 * Class PermissionDeleted.
 */
class PermissionDeleted
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
