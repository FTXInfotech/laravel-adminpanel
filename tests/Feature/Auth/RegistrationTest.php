<?php

namespace Tests\Feature\Auth;

use App\Events\Frontend\Auth\UserRegistered;
use App\Models\Access\User\User;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
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
    public function user_can_register()
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

    /**
     * Test the registration form when account are set to be pending an approval
     * ensure they are registered but not confirmed.
     */

    /** @test */
    public function registration_for_pending_approval()
    {
        Event::fake();
        Notification::fake();

        // Set registration to pending approval
        config(['access.users.confirm_email' => false]);
        config(['access.users.requires_approval' => true]);

        $this->visit('/register')
            ->type('first name', 'first_name')
            ->type('last name', 'last_name')
            ->type('test@example.com', 'email')
            ->type('Viral@1234', 'password')
            ->type('Viral@1234', 'password_confirmation')
            ->check('is_term_accept')
            ->press('Register')
            ->see('Your account was successfully created and is pending approval. An e-mail will be sent when your account is approved.')
            ->see('Login')
            ->seePageIs('/')
            ->seeInDatabase(config('access.users_table'),
                [
                    'email'      => 'test@example.com',
                    'first_name' => 'first name',
                    'last_name'  => 'last name',
                    'confirmed'  => 0,
                ]);

        // Get the user that was inserted into the database
        $user = User::where('email', 'test@example.com')->first();

        Notification::assertNotSentTo([$user], UserNeedsConfirmation::class);
        Event::assertDispatched(UserRegistered::class);
    }
}
