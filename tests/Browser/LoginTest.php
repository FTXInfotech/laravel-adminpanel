<?php

namespace Tests\Browser;

use App\Models\Access\User\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Login;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /** @test */
    public function it_can_login_a_admin_user()
    {
        $user = User::find(1);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new Login())
                ->type('email', $user->email)
                ->type('password', '1234')
                ->press('Login')
                ->assertSee('Dashboard')
                ->assertSee('Access Management');
        });
    }

    /* @test */
    // public function it_can_see_the_login_page()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit(new Login());
    //     });
    // }

    /* @test */
    // public function login_fails_when_a_required_field_is_not_filled_in()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit(new Login())
    //             ->type('email', '')
    //             ->type('password', '')
    //             ->press('Login')
    //             ->assertPathIs('/login')
    //             ->assertSee('The email field is required.')
    //             ->assertSee('The password field is required.');
    //     });
    // }
}
