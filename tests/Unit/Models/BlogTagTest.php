<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\BlogTags\BlogTag;
use App\Models\Access\User\User;

class BlogTagTest extends TestCase
{
    /** @test */
    public function it_has_a_creator()
    {
        $this->actingAs($this->admin);

        $tag = create(BlogTag::class, ['created_by' => access()->id()]);

        $this->assertInstanceOf(User::class, $tag->creator);

        $this->assertEquals($tag->creator->id, access()->id());
    }
}
