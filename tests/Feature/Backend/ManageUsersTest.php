<?php

namespace Tests\Feature\Backend;

use App\Events\Backend\Access\User\UserCreated;
use App\Models\Access\Permission\Permission;
use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ManageUsersTest extends TestCase
{
    /**
     * Create User.
     *
     * @param  $overrides
     *
     * @return [array] User array
     */
    protected function createUser($overrides = [])
    {
        $user = factory(User::class, $overrides = [])->states('active', 'confirmed')->make()->toArray();

        return $this->withExceptionHandling()
                    ->actingAs($this->admin)
                    ->post(route('admin.access.user.store'), $user);
    }

    /** @test */
    public function a_user_can_view_active_users()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.access.user.index'))
            ->assertViewIs('backend.access.users.index')
            ->assertSee(trans('labels.backend.access.users.management'))
            ->assertSee(trans('labels.backend.access.users.active'))
            ->assertSee('Export')
            ->assertSee('Action');
    }

    /** @test */
    public function a_user_can_view_deactevated_users()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.access.user.deactivated'))
            ->assertViewIs('backend.access.users.deactivated')
            ->assertSee(trans('labels.backend.access.users.management'))
            ->assertSee(trans('labels.backend.access.users.deactivated'))
            ->assertSee('Export')
            ->assertSee('Action');
    }

    /** @test */
    public function a_user_can_view_deleted_users()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.access.user.deleted'))
            ->assertViewIs('backend.access.users.deleted')
            ->assertSee(trans('labels.backend.access.users.management'))
            ->assertSee(trans('labels.backend.access.users.deleted'))
            ->assertSee('Export')
            ->assertSee('Action');
    }

    /** @test */
    public function a_user_can_view_single_user()
    {
        $this->actingAs($this->admin)
             ->get('/admin/access/user/'.$this->admin->id)
             ->assertViewIs('backend.access.users.show')
             ->assertSee('View User')
             ->assertSee('Overview')
             ->assertSee('History')
             ->assertSee($this->admin->first_name)
             ->assertSee($this->admin->last_name)
             ->assertSee($this->admin->email);
    }

    /** @test */
    public function a_user_requires_a_first_name()
    {
        $this->createUser(['first_name' => null])
            ->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function a_user_requires_a_last_name()
    {
        $this->createUser(['last_name' => null])
            ->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function a_user_requires_a_email()
    {
        $this->createUser(['email' => null])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_user_requires_a_password()
    {
        $this->createUser(['password' => null])
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function a_user_requires_a_confirm_password()
    {
        $user = factory(User::class)->states('active', 'confirmed')->make()->toArray();

        $user['password'] = 'Viral@1234';
        $user['password_confirmation'] = 'Viral@1235';

        $this->withExceptionHandling()
             ->actingAs($this->admin)
            ->post(route('admin.access.user.store'), $user)
            ->assertSessionHasErrors('password');
    }

    /** @test */
    public function a_user_requires_a_role()
    {
        $this->createUser()
            ->assertSessionHasErrors('assignees_roles');
    }

    /** @test */
    public function a_user_requires_a_permission()
    {
        $this->createUser()
            ->assertSessionHasErrors('permissions');
    }

    /** @test */
    public function create_user_fails_if_email_is_exists()
    {
        $this->createUser(['email' => 'admin@admin.com'])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_user_can_create_new_user()
    {
        // Make sure our events are fired
        Event::fake();

        $user = factory(User::class)->states('active', 'confirmed')->make()->toArray();
        $role = create(Role::class);

        $permission = create(Permission::class);

        $user['password'] = 'Viral@1234';
        $user['password_confirmation'] = 'Viral@1234';
        $user['assignees_roles'] = [$role->id];
        $user['permissions'] = [$permission->id];

        $this->actingAs($this->admin)
            ->post(route('admin.access.user.store'), $user)
            ->assertRedirect(route('admin.access.user.index'));

        $this->assertDatabaseHas(config('access.users_table'), [
            'first_name' => $user['first_name'],
            'last_name'  => $user['last_name'],
            'email'      => $user['email'],
            'status'     => 1,
            'confirmed'  => 1,
        ]);
        $this->assertDatabaseHas(config('access.roles_table'), ['name' => $role->name]);
        $this->assertDatabaseHas(config('access.permissions_table'), ['name' => $permission->name]);
        $this->assertDatabaseHas(config('access.role_user_table'), ['role_id' => $role->id]);

        Event::assertDispatched(UserCreated::class);
    }

    /** @test */
    public function an_email_will_be_sent_to_uncomfirmed_user()
    {
        // Make sure our events are fired
        Event::fake();

        // Make sure our notifications are sent
        Notification::fake();

        $user = factory(User::class)->states('active')->make()->toArray();
        $role = create(Role::class);

        $permission = create(Permission::class);

        $user['password'] = 'Viral@1234';
        $user['password_confirmation'] = 'Viral@1234';
        $user['confirmation_email'] = 1;
        $user['assignees_roles'] = [$role->id];
        $user['permissions'] = [$permission->id];

        $this->actingAs($this->admin)
            ->post(route('admin.access.user.store'), $user)
            ->assertRedirect(route('admin.access.user.index'));

        $this->assertDatabaseHas(config('access.users_table'), [
            'first_name' => $user['first_name'],
            'last_name'  => $user['last_name'],
            'email'      => $user['email'],
            'status'     => 1,
            'confirmed'  => 0,
        ]);
        $this->assertDatabaseHas(config('access.roles_table'), ['name' => $role->name]);
        $this->assertDatabaseHas(config('access.permissions_table'), ['name' => $permission->name]);
        $this->assertDatabaseHas(config('access.role_user_table'), ['role_id' => $role->id]);

        // Get the user that was inserted into the database
        $insertedUser = User::where('email', $user['email'])->first();

        // Check that the user was sent the confirmation email
        Notification::assertSentTo([$insertedUser], UserNeedsConfirmation::class);

        Event::assertDispatched(UserCreated::class);
    }

    //@todo
    //  update user
    //  delete user
    //  user can not delete himself
    //  change password
    //  export / import feature
}
