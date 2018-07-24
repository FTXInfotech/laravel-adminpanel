<?php

namespace Tests\Feature\Auth;

use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Tests\BrowserKitTestCase;

class ResetPasswordTest extends BrowserKitTestCase
{
    /** @test */
    public function forgot_password_page_loads_properly()
    {
        $this->visit('/password/reset')
            ->see('Email')
            ->see('Reset Password');
    }

    /** @test **/
    public function forgot_password_fails_when_a_required_field_is_not_filled_in()
    {
        $this->visit('/password/reset')
             ->type('', 'email')
             ->press('Send Password Reset Link')
             ->seePageIs('/password/reset')
             ->see('The email field is required.');
    }

    /** @test **/
    public function users_can_request_a_password_reset_link()
    {
        Notification::fake();

        $this->visit('password/reset')
             ->type($this->user->email, 'email')
             ->press('Send Password Reset Link')
             ->seePageIs('password/reset')
             ->see('We have e-mailed your password reset link!')
             ->seeInDatabase('password_resets', ['email' => $this->user->email]);

        Notification::assertSentTo(
            [$this->user],
            UserNeedsPasswordReset::class
        );
    }

    /** @test **/
    public function reset_password_fails_when_a_required_field_is_not_filled_in()
    {
        $token = $this->app->make('auth.password.broker')->createToken($this->user);

        $this->visit('password/reset/'.$token)
             ->see($this->user->email)
             ->type('', 'password')
             ->type('', 'password_confirmation')
             ->press('Reset Password')
             ->see('The password field is required.');
    }

    /** @test **/
    public function users_can_reset_password()
    {
        $token = $this->app->make('auth.password.broker')->createToken($this->user);

        $this->visit('password/reset/'.$token)
             ->see($this->user->email)
             ->type('12345678', 'password')
             ->type('12345678', 'password_confirmation')
             ->press('Reset Password')
             ->see($this->user->first_name);
    }
}
