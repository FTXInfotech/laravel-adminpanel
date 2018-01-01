<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Access\User\User;
use App\Models\BlogCategories\BlogCategory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogCategoryTest extends TestCase
{
    /** @test */
    public function it_has_a_creator()
    {
        $this->actingAs($this->admin);

        $category = create(BlogCategory::class, ['created_by' => access()->id()]);

        $this->assertInstanceOf(User::class, $category->creator);

        $this->assertEquals($category->creator->id, access()->id());
    }
}
