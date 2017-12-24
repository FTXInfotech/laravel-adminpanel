<?php

namespace Tests\Feature;

use App\Events\Frontend\Auth\UserLoggedIn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Tests\BrowserKitTestCase;

class LoginTest extends BrowserKitTestCase
{
    /** @test */
    public function login_page_loads_properly()
    {
        $this->visit('/login')
            ->see('Email')
            ->see('Password')
            ->see('Login')
            ->dontSee('You are logged in!');
    }

    /** @test */
    public function login_fails_when_a_required_field_is_not_filled_in()
    {
        $this->visit('/login')
             ->type('', 'email')
             ->type('', 'password')
             ->press('Login')
             ->seePageIs('/login')
             ->see('The email field is required.')
             ->see('The password field is required.');
    }

    /** @test */
    public function login_fails_when_password_is_incorrect()
    {
        $this->visit('/login')
            ->type('admin@admin.com', 'email')
            ->type('invalidpass', 'password')
            ->press('Login')
            ->seePageIs('/login')
            ->see('These credentials do not match our records.');
    }

    /** @test */
    public function login_failure_with_wrong_inputs()
    {
        $this->visit("/login")
            ->type('wrongusername@wrongpassword.com', 'email')
            ->type('wrongpassword', 'password')
            ->press('Login')
            ->seePageIs('/login')
            ->see('These credentials do not match our records.');
    }

    /** @test */
    public function users_can_login()
    {
        // Make sure our events are fired
        Event::fake();

        Auth::logout();

        //User Test
        $this->visit('/login')
                    ->type($this->user->email, 'email')
                    ->type('1234', 'password')
                    ->press('Login')
                    ->see($this->user->name)
                    ->seePageIs('/dashboard');

        Auth::logout();

        //Admin Test
        $this->visit('/login')
                    ->type($this->admin->email, 'email')
                    ->type('1234', 'password')
                    ->press('Login')
                    ->seePageIs('/admin/dashboard')
                    ->see($this->admin->first_name)
                    ->see('Access Management');

        Event::assertDispatched(UserLoggedIn::class);
    }
}
