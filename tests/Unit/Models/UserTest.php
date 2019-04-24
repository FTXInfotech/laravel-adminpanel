<?php

namespace Tests\Unit\Models;

use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_has_a_roles()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->admin->roles
        );
    }

    /** @test */
    public function a_user_has_a_permissions()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->admin->permissions
        );
    }

    /** @test */
    public function a_user_has_a_providers()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->admin->providers
        );
    }

    /** @test */
    public function a_user_has_a_sessions()
    {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $this->admin->sessions
        );
    }
}
