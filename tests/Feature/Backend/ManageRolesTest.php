<?php

namespace Tests\Feature\Backend;

use App\Events\Backend\Access\Role\RoleCreated;
use App\Events\Backend\Access\Role\RoleDeleted;
use App\Events\Backend\Access\Role\RoleUpdated;
use App\Exceptions\GeneralException;
use App\Models\Access\Permission\Permission;
use App\Models\Access\Role\Role;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ManageRolesTest extends TestCase
{
    /** @test */
    public function a_user_can_view_roles()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.access.role.index'))
            ->assertViewIs('backend.access.roles.index')
            ->assertSee(trans('labels.backend.access.roles.management'))
            ->assertSee('Action');
    }

    /** @test */
    public function a_role_requires_a_name()
    {
        $role = make(Role::class, ['name' => null])->toArray();

        return $this->withExceptionHandling()
                    ->actingAs($this->admin)
                    ->post(route('admin.access.role.store'), $role)
                    ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_role_requires_a_permission_if_associated_permissions_is_not_set_to_all()
    {
        $role = make(Role::class)->toArray();
        $role['associated_permissions'] = 'custom';

        return $this->withExceptionHandling()
                    ->actingAs($this->admin)
                    ->post(route('admin.access.role.store'), $role)
                    ->assertSessionHasErrors('permissions');
    }

    /** @test */
    /*public function a_role_can_not_create_if_name_is_already_exists()
    {
        $role = make(Role::class, ['name' => $this->adminRole->name])->toArray();

        return $this->withExceptionHandling()
                    ->actingAs($this->admin)
                    ->post(route('admin.access.role.store'), $role);

        $this->assertSessionHas(['flash_danger' => trans('exceptions.backend.access.roles.already_exists')]);
        $this->expectException(GeneralException::class);
    }*/

    /** @test */
    public function a_user_can_create_new_role()
    {
        // Make sure our events are fired
        Event::fake();

        $role = make(Role::class, ['name' => 'test Role'])->toArray();
        $role['associated_permissions'] = 'all';

        $this->actingAs($this->admin)
            ->post(route('admin.access.role.store'), $role)
            ->assertRedirect(route('admin.access.role.index'))
            ->assertSessionHas(['flash_success' => trans('alerts.backend.roles.created')]);

        $this->assertDatabaseHas(config('access.roles_table'), [
            'name' => $role['name'],
        ]);

        Event::assertDispatched(RoleCreated::class);
    }

    /** @test */
    public function a_user_can_create_new_role_with_permissions()
    {
        // Make sure our events are fired
        Event::fake();

        $role = make(Role::class, ['name' => 'test Role'])->toArray();
        $permission = create(Permission::class);

        $role['associated_permissions'] = 'custom';
        $role['permissions'] = [$permission->id];

        $this->actingAs($this->admin)
            ->post(route('admin.access.role.store'), $role)
            ->assertRedirect(route('admin.access.role.index'))
            ->assertSessionHas(['flash_success' => trans('alerts.backend.roles.created')]);

        $this->assertDatabaseHas(config('access.roles_table'), [
            'name' => $role['name'],
        ]);

        $this->assertDatabaseHas(config('access.permissions_table'), ['name' => $permission->name]);
        $this->assertDatabaseHas(config('access.permission_role_table'), ['permission_id' => $permission->id]);

        Event::assertDispatched(RoleCreated::class);
    }

    /** @test */
    public function it_fails_for_validation_on_update_role()
    {
        $role = create(Role::class);

        $data = $role->toArray();

        $data['name'] = '';

        $this->withExceptionHandling()
            ->actingAs($this->admin)
            ->patch(route('admin.access.role.update', $role), $data)
            ->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function a_user_can_update_role()
    {
        Event::fake();

        $role = create(Role::class);
        $permission = create(Permission::class);

        $data = $role->toArray();

        $data['associated_permissions'] = 'custom';
        $data['permissions'] = [$permission->id];
        $data['name'] = 'Updated Role Name';

        $this->withExceptionHandling()
            ->actingAs($this->admin)
            ->patch(route('admin.access.role.update', $role), $data)
            ->assertRedirect(route('admin.access.role.index'))
            ->assertSessionHas(['flash_success' => trans('alerts.backend.roles.updated')]);

        $this->assertDatabaseHas(config('access.roles_table'), [
            'name' => $data['name'],
        ]);

        $this->assertDatabaseHas(config('access.permissions_table'), ['name' => $permission->name]);
        $this->assertDatabaseHas(config('access.permission_role_table'), ['permission_id' => $permission->id]);

        Event::assertDispatched(RoleUpdated::class);
    }

    /** @test */
    public function a_user_can_delete_a_role()
    {
        Event::fake();

        $role = create(Role::class);

        $this->actingAs($this->admin)
             ->delete(route('admin.access.role.destroy', $role))
             ->assertStatus(302)
             ->assertSessionHas(['flash_success' => trans('alerts.backend.roles.deleted')]);

        /*$this->assertDatabaseMissing(config('access.roles_table'), [
            'name' => $role->name,
            'id' => $role->id
        ]);*/

        Event::assertDispatched(RoleDeleted::class);
    }
}
