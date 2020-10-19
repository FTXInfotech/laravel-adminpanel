<?php

namespace Tests\Feature\Backend\Role;

use App\Events\Backend\Auth\Role\RoleCreated;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CreateRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_create_role_page()
    {
        $this->loginAsAdmin();

        $this->get(route('admin.auth.role.create'))->assertStatus(200);
    }

    /** @test */
    public function the_name_is_required()
    {
        $this->loginAsAdmin();

        $response = $this->post(route('admin.auth.role.store'), ['name' => '']);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_name_must_be_unique()
    {
        $this->loginAsAdmin();

        $response = $this->post(route('admin.auth.role.store'), ['name' => config('access.users.admin_role'), 'associated_permissions' => 'all']);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function at_least_one_permission_is_required()
    {
        $this->loginAsAdmin();

        $response = $this->post(route('admin.auth.role.store'), ['name' => 'new role']);

        $response->assertSessionHasErrors('permissions');
    }

    /** @test */
    public function a_role_can_be_created()
    {
        $this->loginAsAdmin();

        $permission = factory(Permission::class)->create();

        $roleData = [
            'name' => 'new role',
            'associated_permissions' => 'custom',
            'permissions' => [$permission->id],
        ];

        Event::fake([
            RoleCreated::class,
        ]);

        $this->post(route('admin.auth.role.store'), $roleData);

        $role = Role::where(['name' => 'new role'])->first();

        $this->assertDatabaseHas('roles', [
            'name' => $roleData['name'],
        ]);

        $this->assertSame($permission->id, $role->permissions()->first()->id);

        Event::assertDispatched(RoleCreated::class);
    }
}
