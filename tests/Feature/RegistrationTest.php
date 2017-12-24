<?php

namespace Tests\Feature;

use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Support\Facades\Event;
use Tests\BrowserKitTestCase;

class RegistrationTest extends BrowserKitTestCase
{
    /** @test */
    public function registration_page_loads_properly()
    {
        $this->visit('/register')
            ->see('first_name')
            ->see('last_name')
            ->see('email')
            ->see('password')
            ->see('is_term_accept')
            ->see('Register');
    }

    /** @test */
    public function registration_fails_when_a_required_field_is_not_filled_in()
    {
        $this->visit('/register')
             ->type('', 'first_name')
             ->type('', 'last_name')
             ->type('', 'email')
             ->type('', 'password')
             ->press('Register')
             ->seePageIs('/register')
             ->see('The first name field is required.')
             ->see('The last name field is required.')
             ->see('The email field is required.')
             ->see('The password field is required.')
             ->see('The is term accept field is required.');
    }

    /**
     * Test the registration form
     * Test it works with confirming email on or off, and that the confirm email notification is sent
     * Note: Captcha is disabled by default in phpunit.xml.
     */

    /** @test */
    public function test_registration_form()
    {
        // Make sure our events are fired
        Event::fake();

        config(['access.users.confirm_email' => false]);
        config(['access.users.requires_approval' => false]);

        $this->visit('/register')
            ->type('John', 'first_name')
            ->type('Doe', 'last_name')
            ->type('john.doe@example.com', 'email')
            ->type('Viral@1234', 'password')
            ->type('Viral@1234', 'password_confirmation')
            ->check('is_term_accept')
            ->press('Register')
            ->seePageIs('/')
            ->seeInDatabase(config('access.users_table'),
             [
                 'email'      => 'john.doe@example.com',
                 'first_name' => 'John',
                 'last_name'  => 'Doe',
                 'confirmed'  => 1,
             ]);

        Event::assertDispatched(UserRegistered::class);
    }
}
