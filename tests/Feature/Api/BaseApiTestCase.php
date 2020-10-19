<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use RoleTableSeeder;
use App\Models\Auth\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BaseApiTestCase extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleTableSeeder::class);
        $user = factory(User::class)->create();
        // Attach administrative roles
        $user->attachRole(1);
        Passport::actingAs($user);
    }
}
