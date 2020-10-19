<?php

namespace Tests\Feature\Api;

use App\Models\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use RoleTableSeeder;
use Tests\TestCase;

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
