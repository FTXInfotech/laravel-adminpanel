<?php

namespace Tests\Feature\Api;

use App\Models\BlogCategory;
use Illuminate\Http\Response;

class BlogCategoriesControllerTest extends BaseApiTestCase
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
     * Test List Blog Category.
     */
    public function testListBlogCategory()
    {
        factory(BlogCategory::class, 10)->create();

        $this->getJson('api/v1/blog-categories')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
                'meta',
                'links',
            ]);
    }

    /**
     * Test List Blog Category Fetch All.
     */
    public function testListBlogCategoryFetchAll()
    {
        factory(BlogCategory::class, 100)->create();

        $this->getJson('api/v1/blog-categories?per_page=-1')
            ->assertOk()
            ->assertJsonCount(100, 'data.*')
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
            ]);
    }

    /**
     * Test Show Blog Category.
     */
    public function testShowBlogCategory()
    {
        factory(BlogCategory::class)->create([
            'id' => 1,
        ]);

        $this->getJson('api/v1/blog-categories/1')
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Test Delete Blog Category.
     */
    public function testDeleteBlogCategory()
    {
        factory(BlogCategory::class)->create([
            'id' => 1,
        ]);

        $this->deleteJson('api/v1/blog-categories/1')
            ->assertNoContent();
    }

    /**
     * Test Store Blog Category Validation.
     */
    public function testStoreBlogCategoryValidation()
    {
        $this->postJson('api/v1/blog-categories')
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
     * Test Store Blog Category.
     */
    public function testStoreBlogCategory()
    {
        $payload = [
            'name' => $this->faker->word,
            'status' => $this->faker->boolean,
        ];

        $this->postJson('api/v1/blog-categories', $payload)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Test Update Blog Category.
     */
    public function testUpdateBlogCategory()
    {
        factory(BlogCategory::class)->create([
            'id' => 1,
            'status' => false,
        ]);

        $payload = [
            'name' => 'Name Updated',
            'status' => true,
        ];

        $this->patchJson('api/v1/blog-categories/1', $payload)
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
