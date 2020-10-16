<?php

namespace Tests\Feature\Backend\User;

use App\Events\Backend\Auth\User\UserUpdated;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_edit_user_page()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create();

        $response = $this->get(route('admin.auth.user.edit', $user));

        $response->assertStatus(200);
    }

    /** @test  */
    public function an_admin_can_resend_users_confirmation_email()
    {
        $this->markTestIncomplete('See here notification working, but not logging.');

        $this->loginAsAdmin();
        $user = factory(User::class)->states('unconfirmed')->create();

        Notification::fake();

        $this->get(route('admin.auth.user.account.confirm.resend', $user));

        Notification::assertSentTo($user, UserNeedsConfirmation::class);
    }

    /** @test */
    public function a_user_can_be_updated()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $permissions = factory(Permission::class, 3)->create();

        Event::fake();

        $this->assertNotSame('John', $user->first_name);
        $this->assertNotSame('Doe', $user->last_name);
        $this->assertNotSame('john@example.com', $user->email);

        $this->patch(route('admin.auth.user.update', $user), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'assignees_roles' => [$role->id],
            'permissions' => $permissions->pluck('id')->toArray(),
        ]);

        $user = $user->refresh();

        $this->assertSame('John', $user->first_name);
        $this->assertSame('Doe', $user->last_name);
        $this->assertSame('john@example.com', $user->email);

        Event::assertDispatched(UserUpdated::class);
    }
}
