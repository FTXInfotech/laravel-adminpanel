<?php

namespace Tests\Feature\Api;

use App\Models\Blog;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BlogsControllerTest extends BaseApiTestCase
{
    /**
     * Api Response Fields.
     *
     * @var array
     */
    private $apiResponseFields = [
        'id',
        'name',
        'publish_datetime',
        'content',
        'meta_title',
        'cannonical_link',
        'meta_keywords',
        'meta_description',
        'status',
        'display_status',
        'categories',
        'tags',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    /**
     * Test List Blog.
     */
    public function testListBlog()
    {
        factory(Blog::class, 10)->create();

        $this->getJson('api/v1/blogs')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
            ]);
    }

    /**
     * Test List Blog Fetch All.
     */
    public function testListBlogFetchAll()
    {
        factory(Blog::class, 100)->create();

        $this->getJson('api/v1/blogs?per_page=-1')
            ->assertOk()
            ->assertJsonCount(100, 'data.*')
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
            ]);
    }

    /**
     * Test Show Blog.
     */
    public function testShowBlog()
    {
        factory(Blog::class)->create([
            'id' => 1,
        ]);

        $this->getJson('api/v1/blogs/1')
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Test Delete Blog.
     */
    public function testDeleteBlog()
    {
        factory(Blog::class)->create([
            'id' => 1,
        ]);

        $this->deleteJson('api/v1/blogs/1')
            ->assertNoContent();
    }

    /**
     * Test Store Blog Validation.
     */
    public function testStoreBlogValidation()
    {
        $this->postJson('api/v1/blogs')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'error' => [
                    'message' => [
                        'name',
                        'publish_datetime',
                        'content',
                        'categories',
                        'tags',
                    ],
                ],
            ]);
    }

    /**
     * Test Store Blog.
     */
    public function testStoreBlog()
    {
        Storage::fake('public');

        $this->postJson('api/v1/blogs', $this->getPayload())
            ->assertCreated()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);

        $this->assertNotSame([], Storage::allFiles('public'));
    }

    /**
     * Test Update Blog.
     */
    public function testUpdateBlog()
    {
        factory(Blog::class)->create([
            'id' => 1,
        ]);

        $payload = array_merge($this->getPayload(), [
            'name' => 'Blog Name Updated',
            'categories' => [
                'test new category 1',
                'test new category 2',
            ],
        ]);

        $this->patchJson('api/v1/blogs/1', $payload)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'name' => 'Blog Name Updated',
                    'categories' => [
                        [
                            'name' => 'test new category 1',
                        ],
                        [
                            'name' => 'test new category 2',
                        ],
                    ],
                ],
            ])
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Get Payload.
     *
     * @return array
     */
    public function getPayload(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'publish_datetime' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            'content' => $this->faker->paragraph,
            'categories' => [
                $this->faker->word,
            ],
            'tags' => [
                $this->faker->word,
            ],
            'status' => $this->faker->numberBetween(0, 3),
            'meta_title' => $this->faker->word,
            'cannonical_link' => $this->faker->url,
            'meta_keywords' => $this->faker->word,
            'meta_description' => $this->faker->sentence,
            'featured_image' => UploadedFile::fake()->create('sample.jpg'),
        ];
    }
}
