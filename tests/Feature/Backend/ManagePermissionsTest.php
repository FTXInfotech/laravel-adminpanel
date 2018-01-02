<?php

namespace Tests\Feature\Backend;

use App\Models\Access\Permission\Permission;
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
            ->assertSee('Export')
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
}
