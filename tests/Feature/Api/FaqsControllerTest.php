<?php

namespace Tests\Feature\Api;

use App\Models\Faq;
use Illuminate\Http\Response;

class FaqsControllerTest extends BaseApiTestCase
{
    /**
     * Api Response Fields.
     *
     * @var array
     */
    private $apiResponseFields = [
        'id',
        'question',
        'answer',
        'status',
        'display_status',
        'created_at',
        'updated_at',
    ];

    /**
     * Test List Faq.
     */
    public function testListFaq()
    {
        factory(Faq::class, 10)->create();

        $this->getJson('api/v1/faqs')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
            ]);
    }

    /**
     * Test List Faq Fetch All.
     */
    public function testListFaqFetchAll()
    {
        factory(Faq::class, 100)->create();

        $this->getJson('api/v1/faqs?per_page=-1')
            ->assertOk()
            ->assertJsonCount(100, 'data.*')
            ->assertJsonStructure([
                'data' => [
                    $this->apiResponseFields,
                ],
            ]);
    }

    /**
     * Test Show Faq.
     */
    public function testShowFaq()
    {
        factory(Faq::class)->create([
            'id' => 1,
        ]);

        $this->getJson('api/v1/faqs/1')
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Test Delete Faq.
     */
    public function testDeleteFaq()
    {
        factory(Faq::class)->create([
            'id' => 1,
        ]);

        $this->deleteJson('api/v1/faqs/1')
            ->assertNoContent();
    }

    /**
     * Test Store Faq Validation.
     */
    public function testStoreFaqValidation()
    {
        $this->postJson('api/v1/faqs')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'error' => [
                    'message' => [
                        'question',
                        'answer',
                    ],
                ],
            ]);
    }

    /**
     * Test Store Faq.
     */
    public function testStoreFaq()
    {
        $payload = [
            'question' => $this->faker->sentence,
            'answer' => $this->faker->paragraph,
            'status' => $this->faker->boolean,
        ];

        $this->postJson('api/v1/faqs', $payload)
            ->assertCreated()
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }

    /**
     * Test Update Faq.
     */
    public function testUpdateFaq()
    {
        factory(Faq::class)->create([
            'id' => 1,
            'status' => false,
        ]);

        $payload = [
            'question' => 'Question Updated',
            'answer' => 'Answer Updated',
            'status' => true,
        ];

        $this->patchJson('api/v1/faqs/1', $payload)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'question' => 'Question Updated',
                    'answer' => 'Answer Updated',
                    'status' => true,
                ],
            ])
            ->assertJsonStructure([
                'data' => $this->apiResponseFields,
            ]);
    }
}
