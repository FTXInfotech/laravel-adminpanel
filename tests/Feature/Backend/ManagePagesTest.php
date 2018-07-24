<?php

namespace Tests\Feature\Backend;

use App\Models\Page\Page;
use Tests\TestCase;

class ManagePagesTest extends TestCase
{
    /** @test */
    public function a_user_can_view_pages()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.pages.index'))
            ->assertSee(trans('labels.backend.pages.management'))
            ->assertSee(trans('labels.backend.pages.table.title'))
            ->assertSee(trans('labels.backend.pages.table.status'))
            ->assertSee($this->admin->name);
    }

    /** @test */
    public function test_create_and_edit_page_has_all_fields()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.pages.create'))
            ->assertSee(trans('validation.attributes.backend.pages.title'))
            ->assertSee(trans('validation.attributes.backend.pages.description'))
            ->assertSee(trans('validation.attributes.backend.pages.cannonical_link'))
            ->assertSee(trans('validation.attributes.backend.pages.seo_title'))
            ->assertSee(trans('validation.attributes.backend.pages.seo_keyword'))
            ->assertSee(trans('validation.attributes.backend.pages.seo_description'))
            ->assertSee(trans('validation.attributes.backend.pages.is_active'));

        $page = create(Page::class);

        $this->actingAs($this->admin)
            ->get(route('admin.pages.edit', $page))
            ->assertSee(trans('validation.attributes.backend.pages.title'))
            ->assertSee(trans('validation.attributes.backend.pages.description'))
            ->assertSee(trans('validation.attributes.backend.pages.cannonical_link'))
            ->assertSee(trans('validation.attributes.backend.pages.seo_title'))
            ->assertSee(trans('validation.attributes.backend.pages.seo_keyword'))
            ->assertSee(trans('validation.attributes.backend.pages.seo_description'))
            ->assertSee(trans('validation.attributes.backend.pages.is_active'));
    }

    /** @test */
    public function a_user_can_create_page()
    {
        $page = make(Page::class);

        $this->actingAs($this->admin)
            ->post(route('admin.pages.store'), $page->toArray())
            ->assertRedirect(route('admin.pages.index'));

        $this->assertDatabaseHas('pages', ['title' => $page->title,  'description' => $page->description]);
    }

    /** @test */
    public function it_requires_title_on_create()
    {
        $page = make(Page::class, ['title' => '']);

        $this->withExceptionHandling()
            ->actingAs($this->admin)
            ->post(route('admin.pages.store'), $page->toArray())
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function it_requires_description_while_create()
    {
        $page = make(Page::class, ['description' => '']);

        $this->withExceptionHandling()
            ->actingAs($this->admin)
            ->post(route('admin.pages.store'), $page->toArray())
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_update_page()
    {
        $page = create(Page::class);
        $title = 'Changed title';
        $slug = str_slug($title);
        $description = 'Changed Description';

        $this->actingAs($this->admin)
            ->patch(route('admin.pages.update', $page), ['title' => $title, 'description' => $description]);

        $this->assertDatabaseHas('pages', ['id' => $page->id, 'title' => $title, 'page_slug' => $slug, 'description' => $description]);
    }

    /** @test */
    public function it_requires_title_on_update()
    {
        $page = create(Page::class);

        $page1 = $page->toArray();

        $page1['title'] = '';

        $this->withExceptionHandling()
            ->actingAs($this->admin)
            ->patch(route('admin.pages.update', $page), $page1)
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function it_requires_description_while_update()
    {
        $page = create(Page::class);

        $page1 = $page->toArray();

        $page1['description'] = '';

        $this->withExceptionHandling()
            ->actingAs($this->admin)
            ->patch(route('admin.pages.update', $page), $page1)
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_delete_a_page()
    {
        $this->actingAs($this->admin);

        $page = create(Page::class);

        $this->delete(route('admin.pages.destroy', $page));

        $this->assertDatabaseMissing(config('module.pages.table'), ['name' => $page->name, 'id' => $page->id, 'deleted_at' => null]);
    }
}
