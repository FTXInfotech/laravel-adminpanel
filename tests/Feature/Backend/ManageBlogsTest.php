<?php

namespace Tests\Feature\Backend;

use App\Models\Blogs\Blog;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ManageBlogsTest extends TestCase
{
    use WithFaker;

    protected $blog;
    protected $categories;
    protected $tags;

    public function setUp()
    {
        parent::setUp();

        $this->actingAs($this->admin);

        $this->blog = create(Blog::class);
        $this->categories = [$this->faker->word, $this->faker->word];
        $this->tags = [$this->faker->word, $this->faker->word];
    }

    /** @test */
    public function a_user_can_view_blogs_index_page()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.blogs.index'))
            ->assertViewIs('backend.blogs.index')
            ->assertSee(trans('labels.backend.blogs.management'))
            ->assertSee(trans('labels.backend.blogs.table.title'))
            ->assertSee(trans('labels.backend.blogs.table.publish'))
            ->assertSee(trans('labels.backend.blogs.table.createdby'))
            ->assertSee(trans('labels.backend.blogs.table.createdat'))
            ->assertSee(trans('labels.backend.blogs.table.status'))
            ->assertSee('Action');
    }

    /** @test */
    public function a_user_can_create_a_blog()
    {
        $blog = make(Blog::class, [
            'featured_image' => UploadedFile::fake()->image('logo.jpg'),
            'categories'     => $this->categories,
            'tags'           => $this->tags,
        ]);

        $this->post(route('admin.blogs.store'), $blog->toArray());

        $this->assertDatabaseHas(config('module.blogs.table'), ['name' => $blog->name, 'status' => $blog->status]);

        //Assert Tags have been saved
        $this->assertDatabaseHas(config('module.blog_tags.table'), ['name' => $this->tags[0]]);
        $this->assertDatabaseHas(config('module.blog_tags.table'), ['name' => $this->tags[1]]);

        //Assert Categories have been saved
        $this->assertDatabaseHas(config('module.blog_categories.table'), ['name' => $this->categories[0]]);
        $this->assertDatabaseHas(config('module.blog_categories.table'), ['name' => $this->categories[1]]);
    }

    public function makeBlog($overrides = [])
    {
        $this->withExceptionHandling();

        $blog = make(Blog::class, $overrides);

        return $blog;
    }

    /** @test */
    public function it_requires_name_while_creating()
    {
        $blog = $this->makeBlog(['name' => '']);

        $this->post(route('admin.blogs.store'), $blog->toArray())
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_requires_content_while_creating()
    {
        $blog = $this->makeBlog(['content' => '']);

        $this->post(route('admin.blogs.store'), $blog->toArray())
            ->assertSessionHasErrors('content');
    }

    /** @test */
    public function it_requires_featured_image_while_creating()
    {
        $blog = $this->makeBlog(['featured_image' => '']);

        $this->post(route('admin.blogs.store'), $blog->toArray())
            ->assertSessionHasErrors('featured_image');
    }

    /** @test */
    public function it_requires_publish_datetime_while_creating()
    {
        $blog = $this->makeBlog();

        unset($blog->publish_datetime);

        $this->post(route('admin.blogs.store'), $blog->toArray())
            ->assertSessionHasErrors('publish_datetime');
    }

    /** @test */
    public function it_requires_categories_while_creating()
    {
        $blog = $this->makeBlog(['categories' => '']);

        $this->post(route('admin.blogs.store'), $blog->toArray())
            ->assertSessionHasErrors('categories');
    }

    /** @test */
    public function it_requires_tags_while_creating()
    {
        $blog = $this->makeBlog(['tags' => '']);

        $this->post(route('admin.blogs.store'), $blog->toArray())
            ->assertSessionHasErrors('tags');
    }

    /** @test */
    public function it_can_store_featured_image()
    {
        $blog = make(Blog::class, [
            'featured_image' => UploadedFile::fake()->image('logo.jpg'),
            'categories'     => $this->categories,
            'tags'           => $this->tags,
        ]);

        $this->post(route('admin.blogs.store'), $blog->toArray());

        $stored_blog = Blog::find(2);

        Storage::disk('public')->assertExists('img/blog/'.$stored_blog->featured_image);
    }

    /** @test */
    public function it_requires_name_while_updating()
    {
        $this->withExceptionHandling();

        $this->blog->name = '';

        $this->patch(route('admin.blogs.update', $this->blog), $this->blog->toArray())
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_requires_content_while_updating()
    {
        $this->withExceptionHandling();

        $this->blog->content = '';

        $this->patch(route('admin.blogs.update', $this->blog), $this->blog->toArray())
            ->assertSessionHasErrors('content');
    }

    /** @test */
    public function it_requires_publish_datetime_while_updating()
    {
        $this->withExceptionHandling();

        unset($this->blog->publish_datetime);

        $this->patch(route('admin.blogs.update', $this->blog), $this->blog->toArray())
            ->assertSessionHasErrors('publish_datetime');
    }

    /** @test */
    public function it_requires_categories_while_updating()
    {
        $this->withExceptionHandling();

        $this->patch(route('admin.blogs.update', $this->blog), $this->blog->toArray())
            ->assertSessionHasErrors('categories');
    }

    /** @test */
    public function it_requires_tags_while_updating()
    {
        $this->withExceptionHandling();

        $this->patch(route('admin.blogs.update', $this->blog), $this->blog->toArray())
            ->assertSessionHasErrors('tags');
    }

    /** @test */
    public function a_user_can_update_blog()
    {
        $blog = make(Blog::class, [
            'featured_image' => UploadedFile::fake()->image('logo.jpg'),
            'name'           => 'Changed Name',
            'categories'     => $this->categories,
            'tags'           => $this->tags,
        ]);

        $this->patch(route('admin.blogs.update', $this->blog), $blog->toArray());

        $this->assertDatabaseHas(config('module.blogs.table'), ['id' => $this->blog->id, 'name' => 'Changed Name']);
    }

    /** @test */
    public function a_user_can_delete_a_blog()
    {
        $this->delete(route('admin.blogs.destroy', $this->blog));

        $this->assertDatabaseMissing(config('module.blogs.table'), ['id' => $this->blog->id, 'deleted_at' => null]);
    }

    /** @test */
    public function a_user_can_not_update_a_blog_with_same_name()
    {
        $this->actingAs($this->admin)->withExceptionHandling();

        $catCategory = create(Blog::class, ['name' => 'Cat']);
        $dogCategory = create(Blog::class, ['name' => 'Dog']);

        $this->patch(route('admin.blogs.update', $dogCategory),
            ['name' => 'Cat']
        )->assertSessionHasErrors('name');
    }
}
