<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Events\Frontend\Auth\UserLoggedIn;

class AuthTest extends TestCase
{
    /** @test */
    public function users_can_login_through_api()
    {
        $res = $this->json('POST', '/api/v1/auth/login', [
                'email' => $this->user->email,
                'password' => '1234'
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token'
            ]);
    }
}
