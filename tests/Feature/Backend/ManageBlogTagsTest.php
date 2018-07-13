<?php

namespace Tests\Feature\Backend;

use App\Models\BlogTags\BlogTag;
use Tests\TestCase;

class ManageBlogTagsTest extends TestCase
{
    /** @test */
    public function a_user_can_view_blog_tags_index_page()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.blogTags.index'))
            ->assertViewIs('backend.blogtags.index')
            ->assertSee(trans('labels.backend.blogtags.management'))
            ->assertSee(trans('labels.backend.blogtags.table.title'))
            ->assertSee(trans('labels.backend.blogtags.table.status'))
            ->assertSee('Action');
    }

    /** @test */
    public function a_user_can_create_a_blog_tag()
    {
        $this->actingAs($this->admin);

        $tag = make(BlogTag::class);

        $this->post(route('admin.blogTags.store'), $tag->toArray());

        $this->assertDatabaseHas(config('module.blog_tags.table'), ['name' => $tag->name]);
    }

    /** @test */
    public function a_blog_tag_requires_a_name_while_creating()
    {
        $this->actingAs($this->admin)->withExceptionHandling();

        $tag = make(BlogTag::class, ['name' => '']);

        $this->post(route('admin.blogTags.store'), $tag->toArray())
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_blog_tag_requires_a_name_while_updating()
    {
        $this->actingAs($this->admin)->withExceptionHandling();

        $tag = create(BlogTag::class);

        $this->patch(route('admin.blogTags.update', $tag), ['name' => ''])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_update_a_blog_tag()
    {
        $this->actingAs($this->admin);

        $tag = create(BlogTag::class);

        $this->patch(route('admin.blogTags.update', $tag), ['name' => 'New Tag']);

        $this->assertDatabaseHas(config('module.blog_tags.table'), ['name' => 'New Tag', 'id' => $tag->id]);
    }

    /** @test */
    public function a_user_can_delete_a_blog_tag()
    {
        $this->actingAs($this->admin);

        $tag = create(BlogTag::class);

        $this->delete(route('admin.blogTags.destroy', $tag));

        $this->assertDatabaseMissing(config('module.blog_tags.table'), ['name' => $tag->name, 'id' => $tag->id, 'deleted_at' => null]);
    }

    /** @test */
    public function a_user_can_not_update_a_blog_tag_with_same_name()
    {
        $this->actingAs($this->admin)->withExceptionHandling();

        $catTag = create(BlogTag::class, ['name' => 'Cat']);
        $dogTag = create(BlogTag::class, ['name' => 'Dog']);

        $this->patch(route('admin.blogTags.update', $dogTag),
            ['name' => 'Cat']
        )->assertSessionHasErrors('name');
    }
}
