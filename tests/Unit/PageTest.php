<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Page\Page;
use App\Models\Access\User\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
{
    /** @test */
    public function it_has_an_owner()
    {
        $this->actingAs($this->admin);

        $page = create(Page::class);
        
        $this->assertInstanceOf(User::class, $page->owner);
    }
}
