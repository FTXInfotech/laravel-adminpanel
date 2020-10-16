<?php

namespace Tests\Feature\Middleware;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SwitchLanguageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_language_can_be_switched()
    {
        $this->loginAsAdmin();

        $response = $this->get('/lang/ar');

        $response->assertSessionHas('locale', 'ar');
    }
}
