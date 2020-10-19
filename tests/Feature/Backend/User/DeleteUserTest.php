<?php

namespace Tests\Feature\Backend\User;

use App\Events\Backend\Auth\User\UserDeleted;
use App\Events\Backend\Auth\User\UserPermanentlyDeleted;
use App\Events\Backend\Auth\User\UserRestored;
use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_deleted_users_page()
    {
        $this->loginAsAdmin();

        $response = $this->get(route('admin.auth.user.deleted'));

        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_be_soft_deleted()
    {
        $this->loginAsAdmin();
        $userToDelete = factory(User::class)->create();

        Event::fake();

        $response = $this->delete(route('admin.auth.user.destroy', $userToDelete));

        $response->assertSessionHas(['flash_success' => __('alerts.backend.access.users.deleted')]);
        $this->assertDatabaseMissing('users', ['id' => $userToDelete->id, 'deleted_at' => null]);

        Event::assertDispatched(UserDeleted::class, function ($event) use ($userToDelete) {
            return $event->user->id == $userToDelete->id;
        });

        $this->assertSoftDeleted('users', [
            'id' => $userToDelete->id,
            'email' => $userToDelete->email,
        ]);
    }

    /** @test */
    public function a_user_can_not_soft_delete_self()
    {
        $user = $this->loginAsAdmin();

        $response = $this->delete(route('admin.auth.user.destroy', $user));

        $response->assertSessionHas(['flash_danger' => __('exceptions.backend.access.users.cant_delete_self')]);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }

    /** @test */
    public function a_user_must_be_soft_deleted_before_permanently_deleted()
    {
        $this->loginAsAdmin();

        $user = factory(User::class)->create();

        $response = $this->delete(route('admin.auth.user.delete-permanently', $user));
        $response->assertSessionHas(['flash_danger' => __('exceptions.backend.access.users.delete_first')]);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }

    /** @test */
    public function a_user_can_be_hard_deleted_if_already_soft_deleted()
    {
        $this->loginAsAdmin();

        $user = factory(User::class)->create(['deleted_at' => now()]);

        Event::fake();

        $response = $this->delete(route('admin.auth.user.delete-permanently', $user));

        $response->assertSessionHas(['flash_success' => __('alerts.backend.access.users.deleted_permanently')]);
        Event::assertDispatched(UserPermanentlyDeleted::class);
        $this->assertDatabaseMissing('users', ['id' => $user->id, 'email' => $user->email]);
    }

    /** @test */
    public function an_admin_can_restore_a_soft_deleted_users()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->states('softDeleted')->create();
        Event::fake([UserRestored::class]);

        $response = $this->post(route('admin.auth.user.restore', $user));

        $response->assertSessionHas(['flash_success' => __('alerts.backend.access.users.restored')]);

        $this->assertNull($user->refresh()->deleted_at);
        Event::assertDispatched(UserRestored::class);
    }

    /** @test */
    public function a_not_soft_deleted_user_cant_be_restored()
    {
        $this->loginAsAdmin();

        $user = factory(User::class)->create();

        $response = $this->post(route('admin.auth.user.restore', $user));

        $response->assertSessionHas(['flash_danger' => __('exceptions.backend.access.users.cant_restore')]);
    }
}
