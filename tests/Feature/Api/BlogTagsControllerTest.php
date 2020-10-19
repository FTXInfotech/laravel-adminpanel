<?php

namespace Tests\Feature\Api;

use App\Models\BlogTag;
use Illuminate\Http\Response;

class BlogTagsControllerTest extends BaseApiTestCase
{
    /**
     * Api Response Fields.
     *
     * @var array
     */
    private $apiResponseFields = [
        'id',
        'name',
        'status',
        'display_status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    /**
     * Test List Blog Tag.
     */
    public function testListBlogTag()
    {
        factory(BlogTag::class, 10)->create();

        $this->getJson('api/v1/blog-tags')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
            ]);
    }

    /**
     * Test List Blog Tag Fetch All.
     */
    public function testListBlogTagFetchAll()
    {
        factory(BlogTag::class, 100)->create();

        $this->getJson('api/v1/blog-tags?per_page=-1')
            ->assertOk()
            ->assertJsonCount(100, 'data.*')
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
            ]);
    }

    /**
     * Test Show Blog Tag.
     */
    public function testShowBlogTag()
    {
        factory(BlogTag::class)->create([
            'id' => 1,
        ]);

        $this->getJson('api/v1/blog-tags/1')
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Test Delete Blog Tag.
     */
    public function testDeleteBlogTag()
    {
        factory(BlogTag::class)->create([
            'id' => 1,
        ]);

        $this->deleteJson('api/v1/blog-tags/1')
            ->assertNoContent();
    }

    /**
     * Test Store Blog Tag Validation.
     */
    public function testStoreBlogTagValidation()
    {
        $this->postJson('api/v1/blog-tags')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'error' => [
                    'message' => [
                        'name',
                    ],
                ],
            ]);
    }

    /**
     * Test Store Blog Tag.
     */
    public function testStoreBlogTag()
    {
        $payload = [
            'name' => $this->faker->word,
            'status' => $this->faker->boolean,
        ];

        $this->postJson('api/v1/blog-tags', $payload)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Test Update Blog Tag.
     */
    public function testUpdateBlogTag()
    {
        factory(BlogTag::class)->create([
            'id' => 1,
            'status' => false,
        ]);

        $payload = [
            'name' => 'Name Updated',
            'status' => true,
        ];

        $this->patchJson('api/v1/blog-tags/1', $payload)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'name' => 'Name Updated',
                    'status' => true,
                ],
            ])
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }
}
