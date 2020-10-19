<?php

namespace Tests\Feature\Backend\Role;

use App\Events\Backend\Auth\Role\RoleDeleted;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class DeleteRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_role_can_be_deleted()
    {
        $this->loginAsAdmin();

        $role = factory(Role::class)->create();

        $this->assertDatabaseHas('roles', ['id' => $role->id]);

        Event::fake([
            RoleDeleted::class,
        ]);

        $this->delete(route('admin.auth.role.destroy', $role));

        $this->assertSoftDeleted('roles', ['id' => $role->id]);
        Event::assertDispatched(RoleDeleted::class);
    }

    /**
     * @test
     */
    public function a_role_with_assigned_users_cant_be_deleted()
    {
        $this->loginAsAdmin();

        $role = factory(Role::class)->create();
        $user = factory(User::class)->create();
        $role->users()->attach($role->id);

        $response = $this->delete(route('admin.auth.role.destroy', $role));

        $response->assertSessionHas(['flash_danger' => __('exceptions.backend.access.roles.has_users')]);
    }

    /**
     * @test
     */
    public function admin_role_cant_be_deleted()
    {
        $role = factory(Role::class)->create(['id' => 1]);  //We consider 1 as administrator

        $this->loginAsAdmin();

        $response = $this->delete(route('admin.auth.role.destroy', $role));

        $response->assertSessionHas(['flash_danger' => __('exceptions.backend.access.roles.cant_delete_admin')]);
    }
}
