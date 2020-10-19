<?php

namespace Tests\Feature\Backend\User;

use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_active_users_page()
    {
        $this->loginAsAdmin();

        $this->get(route('admin.auth.user.index'))->assertStatus(200)->assertSee('E-mail');
    }

    /** @test */
    public function an_admin_can_view_single_user_page()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create();

        $this->get(route('admin.auth.user.show', $user))->assertStatus(200)->assertSee('Overview');
    }
}
