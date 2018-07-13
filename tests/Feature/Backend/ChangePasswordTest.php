<?php

namespace Tests\Feature\Backend;

use App\Events\Backend\Access\User\UserPasswordChanged;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    /** @test */
    public function a_user_require_old_password_to_change_password()
    {
        $data = [];
        $data['old_password'] = '12345';
        $data['password'] = 'Viral@1234';
        $data['password_confirmation'] = 'Viral@1234';

        $this->withExceptionHandling()
             ->actingAs($this->admin)
             ->patch(route('admin.access.user.change-password', $this->admin), $data)
             ->assertSessionHas(['flash_danger' => trans('exceptions.backend.access.users.change_mismatch')]);
    }

    /** @test */
    /*public function a_user_require_strong_password_to_change_password()
    {
        $data = [];
        $data['old_password'] = '1234';
        $data['password'] = '12345678';
        $data['password_confirmation'] = '12345678';

        $this->withExceptionHandling()
             ->actingAs($this->executive)
             ->patch(route('admin.access.user.change-password', $this->executive), $data)
             ->assertSessionHas('The given data was invalid.');
    }*/

    /** @test */
    public function a_user_can_change_password()
    {
        Event::fake();

        $data = [];
        $data['old_password'] = '1234';
        $data['password'] = 'Viral@1234';
        $data['password_confirmation'] = 'Viral@1234';

        $this->actingAs($this->admin)
             ->patch(route('admin.access.user.change-password', $this->admin), $data)
             ->assertSessionHas(['flash_success' => trans('alerts.backend.users.updated_password')]);

        Event::assertDispatched(UserPasswordChanged::class);
    }
}
