<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Access\Permission\Permission;

class PermissionTest extends TestCase
{
    /** @test */
    public function a_permission_has_roles()
    {
        $permission = Permission::find(1);
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $permission->roles
        );
    }
}
