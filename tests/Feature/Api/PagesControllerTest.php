<?php

namespace Tests\Feature\Api;

use App\Models\Page;
use Illuminate\Http\Response;

class PagesControllerTest extends BaseApiTestCase
{
    /**
     * Api Response Fields.
     *
     * @var array
     */
    private $apiResponseFields = [
        'id',
        'title',
        'description',
        'status_label',
        'status',
        'display_status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    /**
     * Test List Page.
     */
    public function testListPage()
    {
        factory(Page::class, 10)->create();

        $this->getJson('api/v1/pages')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
            ]);
    }

    /**
     * Test List Page Fetch All.
     */
    public function testListPageFetchAll()
    {
        factory(Page::class, 100)->create();

        $this->getJson('api/v1/pages?per_page=-1')
            ->assertOk()
            ->assertJsonCount(100, 'data.*')
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
            ]);
    }

    /**
     * Test Show Page.
     */
    public function testShowPage()
    {
        factory(Page::class)->create([
            'id' => 1,
        ]);

        $this->getJson('api/v1/pages/1')
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Test Delete Page.
     */
    public function testDeletePage()
    {
        factory(Page::class)->create([
            'id' => 1,
        ]);

        $this->deleteJson('api/v1/pages/1')
            ->assertNoContent();
    }

    /**
     * Test Store Page Validation.
     */
    public function testStorePageValidation()
    {
        $this->postJson('api/v1/pages')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'error' => [
                    'message' => [
                        'title',
                        'description',
                    ],
                ],
            ]);
    }

    /**
     * Test Store Page.
     */
    public function testStorePage()
    {
        $payload = [
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->boolean,
            'cannonical_link' => $this->faker->url,
            'seo_title' => $this->faker->word,
            'seo_keyword' => $this->faker->word,
            'seo_description' => $this->faker->paragraph,
        ];

        $this->postJson('api/v1/pages', $payload)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Test Update Page.
     */
    public function testUpdatePage()
    {
        factory(Page::class)->create([
            'id' => 1,
        ]);

        $payload = [
            'title' => 'Page Title Updated',
            'description' => 'Updated Description',
            'status' => true,
        ];

        $this->patchJson('api/v1/pages/1', $payload)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'title' => 'Page Title Updated',
                    'description' => 'Updated Description',
                    'status' => true,
                ],
            ])
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }
}
