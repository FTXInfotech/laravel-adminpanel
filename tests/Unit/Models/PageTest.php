<?php

namespace Tests\Unit\Models;

use App\Models\Access\User\User;
use App\Models\Page\Page;
use Tests\TestCase;

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
