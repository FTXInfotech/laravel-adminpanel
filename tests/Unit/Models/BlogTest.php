<?php

namespace Tests\Unit\Models;

use App\Models\Access\User\User;
use App\Models\BlogCategories\BlogCategory;
use App\Models\Blogs\Blog;
use App\Models\BlogTags\BlogTag;
use Carbon\Carbon;
use Tests\TestCase;

class BlogTest extends TestCase
{
    /** @test */
    public function it_has_categories()
    {
        $this->actingAs($this->admin);

        $blog = create(Blog::class, ['created_by' => access()->id()]);

        $category = create(BlogCategory::class);

        $blog->categories()->sync([$category->id]);

        $this->assertInstanceOf(BlogCategory::class, $blog->categories->first());

        $this->assertEquals($category->id, $blog->categories->first()->id);
    }

    /** @test */
    public function it_has_tags()
    {
        $this->actingAs($this->admin);

        $blog = create(Blog::class, ['created_by' => access()->id()]);

        $tag = create(BlogTag::class);

        $blog->tags()->sync([$tag->id]);

        $this->assertInstanceOf(BlogTag::class, $blog->tags->first());

        $this->assertEquals($tag->id, $blog->tags->first()->id);
    }

    /** @test */
    public function it_has_an_owner()
    {
        $this->actingAs($this->admin);

        $blog = create(Blog::class);

        $this->assertInstanceOf(User::class, $blog->owner);
    }

    /** @test */
    public function it_has_a_carbon_date_field_for_publish_datetime()
    {
        $this->actingAs($this->admin);

        $blog = create(Blog::class);

        $this->assertInstanceOf(Carbon::class, $blog->publish_datetime);
    }
}
