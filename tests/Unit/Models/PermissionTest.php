<?php

namespace Tests\Unit\Models;

use App\Models\Access\Permission\Permission;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    /** @test */
    public function a_permission_has_roles()
    {
        $permission = Permission::find(1);
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $permission->roles
        );
    }
}
