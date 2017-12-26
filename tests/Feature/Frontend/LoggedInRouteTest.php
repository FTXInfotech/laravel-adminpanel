<?php

namespace Tests\Feature\Frontend;

use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Support\Facades\Event;
use Tests\BrowserKitTestCase;

/**
 * Class LoggedInRouteTest.
 */
class LoggedInRouteTest extends BrowserKitTestCase
{
    /**
     * Test the homepage works and the dashboard button appears.
     */
    public function testHomePageLoggedIn()
    {
        $this->actingAs($this->user)->visit('/')->see('Dashboard')->see($this->user->name)->dontSee('Administration');
    }

    /**
     * Test the dashboard page works and displays the users information.
     */

    /** @test */
    public function dashboard_page_loads_properly()
    {
        $this->actingAs($this->user)
             ->visit('/dashboard')
             ->see($this->user->email)
             ->see('Joined')
             ->dontSee('Administration');
    }

    /**
     * Test the account page works and displays the users information.
     */

    /** @test */
    public function account_page_loads_properly()
    {
        $this->actingAs($this->user)
             ->visit('/account')
             ->see('My Account')
             ->see('Profile')
             ->see('Update Information')
             ->see('Change Password')
             ->dontSee('Administration');
    }

    /** @test */
    public function users_can_logout()
    {
        // Make sure our events are fired
        Event::fake();

        $this->actingAs($this->user)->visit('/logout')->see('Login')->see('Register');

        Event::assertDispatched(UserLoggedOut::class);
    }
}
