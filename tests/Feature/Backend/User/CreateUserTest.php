<?php

namespace Tests\Feature\Backend\User;

use App\Events\Backend\Auth\User\UserCreated;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_create_user_page()
    {
        $this->loginAsAdmin();

        $response = $this->get(route('admin.auth.user.create'));

        $response->assertStatus(200);
        $response->assertViewIs('backend.auth.user.create');
    }

    /** @test */
    public function create_user_has_required_fields()
    {
        $this->loginAsAdmin();

        $response = $this->post(route('admin.auth.user.store'), []);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'email', 'password', 'assignees_roles', 'permissions']);
    }

    /** @test */
    public function user_email_needs_to_be_unique()
    {
        $this->loginAsAdmin();
        factory(User::class)->create(['email' => 'john@example.com']);
        $role = factory(Role::class)->create();
        $permissions = factory(Permission::class, 3)->create();

        $response = $this->post(route('admin.auth.user.store'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'active' => '1',
            'confirmed' => '0',
            'timezone' => 'UTC',
            'confirmation_email' => '1',
            'assignees_roles' => [$role->id],
            'permissions' => $permissions->pluck('id')->toArray(),
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertSame(1, User::where('email', 'john@example.com')->count());
    }

    /** @test */
    public function admin_can_create_new_user()
    {
        $this->loginAsAdmin();

        $role = factory(Role::class)->create();
        $permissions = factory(Permission::class, 3)->create();

        Event::fake(UserCreated::class);

        $response = $this->post(route('admin.auth.user.store'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'OC4Nzu270N!QBVi%U%qX',
            'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
            'active' => '1',
            'confirmed' => '1',
            'timezone' => 'UTC',
            'confirmation_email' => '1',
            'assignees_roles' => [$role->id],
            'permissions' => $permissions->pluck('id')->toArray(),
        ]);

        $response->assertSessionHas(['flash_success' => __('alerts.backend.access.users.created')]);

        $user = User::where([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'active' => true,
            'confirmed' => true,
        ])->first();

        $this->assertSame('John', $user->first_name);
        $this->assertSame('Doe', $user->last_name);
        $this->assertSame('john@example.com', $user->email);
        $this->assertSame($role->id, $user->roles->first()->id);

        Event::assertDispatched(UserCreated::class);
    }

    /** @test */
    public function when_an_unconfirmed_user_is_created_a_notification_will_be_sent()
    {
        $this->markTestIncomplete("Notification gets logged in file. Maybe thatswhy assertSentTo don't work.");

        $this->loginAsAdmin();

        $role = factory(Role::class)->create();
        $permissions = factory(Permission::class, 3)->create();

        Notification::fake();

        $response = $this->post(route('admin.auth.user.store'), [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'OC4Nzu270N!QBVi%U%qX',
            'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
            'active' => '1',
            'confirmed' => '0',
            'timezone' => 'UTC',
            'confirmation_email' => '1',
            'assignees_roles' => [$role->id],
            'permissions' => $permissions->pluck('id')->toArray(),
        ]);

        $response->assertSessionHas(['flash_success' => __('alerts.backend.access.users.created')]);

        $user = User::where('email', 'john@example.com')->first();

        Notification::assertSentTo([$user], UserNeedsConfirmation::class);
    }
}
