<?php

namespace Tests\Unit\Models;

use Tests\TestCase;


class UserTest extends TestCase
{
    /** @test */
    function a_user_has_a_roles()
    {

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->admin->roles
        );
    }

    /** @test */
    function a_user_has_a_permissions()
    {

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->admin->permissions
        );
    }

    /** @test */
    function a_user_has_a_providers()
    {

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->admin->providers
        );
    }

    /** @test */
    function a_user_has_a_sessions()
    {

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->admin->sessions
        );
    }
}
