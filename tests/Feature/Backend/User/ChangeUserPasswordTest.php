<?php

namespace Tests\Feature\Backend\User;

use App\Events\Backend\Auth\User\UserPasswordChanged;
use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangeUserPasswordTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function the_user_password_can_be_changed()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create();

        $newPassword = 'Abc@123_45';

        Event::fake([
            UserPasswordChanged::class,
        ]);

        $response = $this->patch(route('admin.auth.user.change-password', $user), [
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        Event::assertDispatched(UserPasswordChanged::class);
        $user->refresh();
        $this->assertTrue(Hash::check($newPassword, $user->password));
        $response->assertSessionHas(['flash_success' => __('alerts.backend.access.users.updated_password')]);
    }

    /** @test */
    public function an_admin_can_access_a_user_change_password_page()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create();

        $response = $this->get(route('admin.auth.user.change-password', $user));

        $response->assertStatus(200);
    }

    /** @test */
    public function the_passwords_must_match()
    {
        $this->loginAsAdmin();
        $user = factory(User::class)->create();

        $response = $this->patch(route('admin.auth.user.change-password', $user), [
            'password' => 'Boilerplate',
            'password_confirmation' => 'Boilerplate01',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function an_admin_can_use_the_same_password_when_history_is_off_on_backend_user_password_change()
    {
        config(['access.users.password_history' => false]);

        $this->loginAsAdmin();
        $user = factory(User::class)->create();

        $newPassword = $this->faker->password(8);

        $response = $this->patch(route('admin.auth.user.change-password', $user), [
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response->assertSessionHas(['flash_success' => __('alerts.backend.access.users.updated_password')]);
        $this->assertTrue(Hash::check($newPassword, $user->fresh()->password));
    }

    /** @test */
    public function an_admin_can_not_use_the_same_password_when_history_is_on_on_backend_user_password_change()
    {
        config(['access.users.password_history' => 3]);

        $this->loginAsAdmin();
        $user = factory(User::class)->create();

        $newPassword = $this->faker->password(8);

        $this->patch(route('admin.auth.user.change-password', $user), [
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response = $this->patch(route('admin.auth.user.change-password', $user), [
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ])->assertSessionHasErrors(['password' => __('auth.password_used')]);
    }
}
