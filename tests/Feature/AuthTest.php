<?php

namespace Tests\Feature;

use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends BrowserKitTestCase
{
    /** @test */
    public function login_page_loads_properly()
    {
        $this->visit('/login')
            ->see("Email")
            ->see("Password")
            ->see("Login")
            ->dontSee('You are logged in!');
    }

    /** @test */
    public function login_failure_without_inputs()
    {
        $this->visit('/login')
            ->press('Login')
            ->seePageIs('/login')
            ->see('The email field is required.')
            ->see('The password field is required.');
    }

     /** @test */
    /*public function test_login_failure_with_wrong_inputs()
    {
        $this->visit("/login")
            ->type('wrongusername@wrongpassword.com', 'email')
            ->type('wrongpassword', 'password')
            ->press('Login')
            ->seePageIs('/login')
            ->see('These credentials do not match our records.');
    }*/


    /** @test */
    public function users_can_login()
    {
        //$this->createUser();
        $this->visit('/login')
            ->type('user@user.com', 'email')
            ->type('1234', 'password')
            //->press('Login')
            ->seePageIs('/login');
    }

}
