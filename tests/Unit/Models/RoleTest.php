<?php

namespace Tests\Unit\Models;

use Tests\TestCase;

class RoleTest extends TestCase
{
    /** @test */
    public function a_role_has_users()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->adminRole->users
        );
    }

    /** @test */
    public function a_role_has_permissions()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->adminRole->permissions
        );
    }
}
