<?php

namespace Tests\Feature\Backend;

use Tests\TestCase;
use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use App\Models\Access\Permission\Permission;

class ManageUsersTest extends TestCase
{
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
    public function a_user_can_create_new_user()
    {
       $user            = factory(User::class)->states('active','confirmed')->make()->toArray();
       $role            = create(Role::class);
       $permission      = create(Permission::class);

       $user['password']                = 'Viral@1234';
       $user['password_confirmation']   = 'Viral@1234';
       $user['assignees_roles']         = [$role->id];
       $user['permissions']             = [$permission->id];

       $this->actingAs($this->admin)
            ->post(route('admin.access.user.store'), $user)
            ->assertRedirect(route('admin.access.user.index'));

        $this->assertDatabaseHas('users', ['first_name' => $user['first_name'], 'last_name' => $user['last_name']]);
        $this->assertDatabaseHas('roles', ['name' => $role->name]);
        $this->assertDatabaseHas('permissions', ['name' => $permission->name]);
    }
}
