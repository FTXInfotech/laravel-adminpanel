<?php

namespace Tests\Feature\Backend;

use App\Models\BlogCategories\BlogCategory;
use Tests\TestCase;

class ManageBlogCategoriesTest extends TestCase
{
    /** @test */
    public function a_user_can_view_blog_categories_index_page()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.blogCategories.index'))
            ->assertViewIs('backend.blogcategories.index')
            ->assertSee(trans('labels.backend.blogcategories.management'))
            ->assertSee(trans('labels.backend.blogcategories.table.title'))
            ->assertSee(trans('labels.backend.blogcategories.table.status'))
            ->assertSee('Action');
    }

    /** @test */
    public function a_user_can_create_a_blog_category()
    {
        $this->actingAs($this->admin);

        $category = make(BlogCategory::class);

        $this->post(route('admin.blogCategories.store'), $category->toArray());

        $this->assertDatabaseHas(config('module.blog_categories.table'), ['name' => $category->name]);
    }

    /** @test */
    public function a_blog_category_requires_a_name_while_creating()
    {
        $this->actingAs($this->admin)->withExceptionHandling();

        $category = make(BlogCategory::class, ['name' => '']);

        $this->post(route('admin.blogCategories.store'), $category->toArray())
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_blog_category_requires_a_name_while_updating()
    {
        $this->actingAs($this->admin)->withExceptionHandling();

        $category = create(BlogCategory::class);

        $this->patch(route('admin.blogCategories.update', $category), ['name' => ''])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_update_a_blog_category()
    {
        $this->actingAs($this->admin);

        $category = create(BlogCategory::class);

        $this->patch(route('admin.blogCategories.update', $category), ['name' => 'New Category']);

        $this->assertDatabaseHas(config('module.blog_categories.table'), ['name' => 'New Category', 'id' => $category->id]);
    }

    /** @test */
    public function a_user_can_delete_a_blog_category()
    {
        $this->actingAs($this->admin);

        $category = create(BlogCategory::class);

        $this->delete(route('admin.blogCategories.destroy', $category));

        $this->assertDatabaseMissing(config('module.blog_categories.table'), ['name' => $category->name, 'id' => $category->id, 'deleted_at' => null]);
    }

    /** @test */
    public function a_user_can_not_update_a_blog_category_with_same_name()
    {
        $this->actingAs($this->admin)->withExceptionHandling();

        $catCategory = create(BlogCategory::class, ['name' => 'Cat']);
        $dogCategory = create(BlogCategory::class, ['name' => 'Dog']);

        $this->patch(route('admin.blogCategories.update', $dogCategory),
            ['name' => 'Cat']
        )->assertSessionHasErrors('name');
    }
}
