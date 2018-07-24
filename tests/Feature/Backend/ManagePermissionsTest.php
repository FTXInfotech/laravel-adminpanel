<?php

namespace Tests\Feature\Backend;

use App\Events\Backend\Access\Permission\PermissionCreated;
use App\Events\Backend\Access\Permission\PermissionDeleted;
use App\Events\Backend\Access\Permission\PermissionUpdated;
use App\Models\Access\Permission\Permission;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ManagePermissionsTest extends TestCase
{
    /** @test */
    public function a_user_can_view_permissions()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.access.permission.index'))
            ->assertViewIs('backend.access.permissions.index')
            ->assertSee(trans('labels.backend.access.permissions.management'))
            ->assertSee('Action');
    }

    /** @test */
    public function a_permission_requires_a_name()
    {
        $permission = make(Permission::class, ['name' => null])->toArray();

        return $this->withExceptionHandling()
                    ->actingAs($this->admin)
                    ->post(route('admin.access.permission.store'), $permission)
                    ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_permission_requires_a_display_name()
    {
        $permission = make(Permission::class, ['display_name' => null])->toArray();

        return $this->withExceptionHandling()
                    ->actingAs($this->admin)
                    ->post(route('admin.access.permission.store'), $permission)
                    ->assertSessionHasErrors('display_name');
    }

    /** @test */
    public function a_user_can_create_new_permission()
    {
        // Make sure our events are fired
        Event::fake();

        $permission = make(Permission::class, ['name' => 'test permission'])->toArray();

        $this->actingAs($this->admin)
            ->post(route('admin.access.permission.store'), $permission)
            ->assertRedirect(route('admin.access.permission.index'))
            ->assertSessionHas(['flash_success' => trans('alerts.backend.permissions.created')]);

        $this->assertDatabaseHas(config('access.permissions_table'), [
            'name' => $permission['name'],
        ]);

        Event::assertDispatched(PermissionCreated::class);
    }

    /** @test */
    public function it_fails_for_validation_on_update_permission()
    {
        $permission = create(Permission::class);

        $data = $permission->toArray();

        $data['name'] = '';

        $this->withExceptionHandling()
            ->actingAs($this->admin)
            ->patch(route('admin.access.permission.update', $permission), $data)
            ->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function a_user_can_update_permission()
    {
        Event::fake();

        $permission = create(Permission::class);

        $data = $permission->toArray();

        $data['name'] = 'Updated Permission Name';

        $this->withExceptionHandling()
            ->actingAs($this->admin)
            ->patch(route('admin.access.permission.update', $permission), $data)
            ->assertRedirect(route('admin.access.permission.index'))
            ->assertSessionHas(['flash_success' => trans('alerts.backend.permissions.updated')]);

        $this->assertDatabaseHas(config('access.permissions_table'), [
            'name' => $data['name'],
        ]);

        Event::assertDispatched(PermissionUpdated::class);
    }

    /** @test */
    public function a_user_can_delete_a_permission()
    {
        Event::fake();

        $permission = create(Permission::class);

        $this->actingAs($this->admin)
             ->delete(route('admin.access.permission.destroy', $permission))
             ->assertStatus(302)
             ->assertSessionHas(['flash_success' => trans('alerts.backend.permissions.deleted')]);

        /*$this->assertDatabaseMissing('permissions', [
            'name' => $permission->name, 'id' => $permission->id
        ]);*/

        Event::assertDispatched(PermissionDeleted::class);
    }
}
