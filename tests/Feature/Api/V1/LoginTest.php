<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function users_can_login_through_api()
    {
        $res = $this->json('POST', '/api/v1/auth/login', [
                'email'    => $this->user->email,
                'password' => '1234',
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token',
            ]);
    }
}
