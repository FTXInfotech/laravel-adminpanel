<?php

namespace Tests\Feature\Frontend;

use App\Events\Frontend\Auth\UserConfirmed;
use App\Models\Access\User\User;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\BrowserKitTestCase;

/**
 * Class LoggedOutRouteTest.
 */
class LoggedOutRouteTest extends BrowserKitTestCase
{
    /**
     * User Logged Out Frontend.
     */

    /** @test */
    public function test_homePage()
    {
        $this->visit('/')->assertResponseOk();
    }

    /** @test */
    public function testLoginPage()
    {
        $this->visit('/login')->see('Login');
    }

    /** @test */
    public function testRegisterPage()
    {
        $this->visit('/register')->see('Register');
    }

    /** @test */
    public function testForgotPasswordPage()
    {
        $this->visit('password/reset')->see('Reset Password');
    }

    /** @test */
    public function testDashboardPageLoggedOut()
    {
        $this->visit('/dashboard')->seePageIs('/login');
    }

    /** @test */
    public function testAccountPageLoggedOut()
    {
        $this->visit('/account')->seePageIs('/login');
    }

    /**
     * Create an unconfirmed user and assure the user gets
     * confirmed when hitting the confirmation route.
     */

    /** @test */
    public function confirm_account_route()
    {
        Event::fake();

        // Create default user to test with
        $unconfirmed = factory(User::class)->states('unconfirmed')->create();
        $unconfirmed->attachRole(3); //User

        $this->visit('/account/confirm/'.$unconfirmed->confirmation_code)
             ->seePageIs('/login')
             ->see('Your account has been successfully confirmed!')
             ->seeInDatabase(config('access.users_table'), ['email' => $unconfirmed->email, 'confirmed' => 1]);

        Event::assertDispatched(UserConfirmed::class);
    }

    /**
     * Assure the user gets resent a confirmation email
     * after hitting the resend confirmation route.
     */

    /** @test */
    public function resend_confirm_account_route()
    {
        Notification::fake();

        $this->visit('/account/confirm/resend/'.$this->user->id)
             ->seePageIs('/login')
             ->see('A new confirmation e-mail has been sent to the address on file.');

        Notification::assertSentTo(
            [$this->user],
            UserNeedsConfirmation::class
        );
    }

    /** @test */
    public function test_404Page()
    {
        $response = $this->call('GET', '7g48hwbfw9eufj');
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertContains('Page Not Found', $response->getContent());
    }
}
