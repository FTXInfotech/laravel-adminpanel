<?php

namespace Tests\Feature\Api\V1;

use App\Models\Access\User\User;
use App\Models\Page\Page;
use JWTAuth;
use Tests\TestCase;

class PageTest extends TestCase
{
    public $token = '';
    public $headers = '';
    public $user = '';

    public function setUp()
    {
        parent::setUp();
        $this->user = User::find(1);

        $this->token = JWTAuth::fromUser($this->user);
        $this->headers = ['Authorization' => 'Bearer '.$this->token];
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * A basic test to get response form pages api.
     *
     * @return void
     */

    /** @test */
    public function Get_records_from_pages()
    {
        $payload = [];
        $response = $this->json('GET', '/api/v1/pages', $payload, $this->headers);
        $response
        ->assertStatus(200)
        ->assertJsonStructure([
            'data'=> [
                [
                    'id',
                    'title',
                    'status_label',
                    'status',
                    'created_at',
                    'created_by',
                ],
            ],
            'links',
            'meta',
        ]);
    }

    /**
     * A basic test to get response form pages api.
     *
     * @return void
     */

    /** @test */
    public function get_one_created_page_from_db()
    {
        $page = create(Page::class);
        $payload = [];
        $response = $this->json('GET', '/api/v1/pages/'.$page->id, $payload, $this->headers);
        $response
            ->assertStatus(200)
            ->assertJson([
                    'data'=> [
                        'id'           => $page->id,
                        'title'        => $page->title,
                        'status_label' => $page->status_label,
                        'status'       => ($page->isActive()) ? 'Active' : 'InActive',
                        'created_by'   => $page->created_by,
                    ],
            ]);
    }

    /**
     * Author: Indra Shastri
     * Date:03-03-2018
     * A basic test to update a page from api.
     *
     *
     * @return void
     */

    /** @test */
    public function update_a_page_in_db_and_get_response()
    {
        $page = make(Page::class);
        $payload = [
            'title'           => $page->title,
            'description'     => $page->description,
            'cannonical_link' => $page->cannonical_link,
            'seo_title'       => 'some tittle',
            'seo_keyword'     => 'some keywords',
            'seo_description' => '<p>&nbsp;</p>↵<h1>SEO Description</h1>↵<p>some seco desctription</p>↵<p>askdsaj;ldsjfd</p>',
            'status'          => '1',
        ];
        $response = '';
        $response = $this->json('PUT', '/api/v1/pages/1', $payload, $this->headers);

        $response->assertStatus(200);
        $response->assertJson([
                    'data'=> [
                        'title'        => $page->title,
                        'status_label' => $page->status_label,
                        'status'       => ($page->isActive()) ? 'Active' : 'InActive',
                        'created_by'   => ''.$this->user->id,
                    ],
            ]);
    }

    /**
     *  Author: Indra Shastri
     *  Date:03-03-2018
     * A basic test to create a page from api.
     *
     * @return void
     */

    /** @test */
    public function create_a_new_page_in_db_and_get_response()
    {
        $page = make(Page::class);
        $payload = [
            'title'           => $page->title,
            'description'     => $page->description,
            'cannonical_link' => $page->cannonical_link,
            'seo_title'       => 'some tittle',
            'seo_keyword'     => 'some keywords',
            'seo_description' => '<p>&nbsp;</p>↵<h1>SEO Description</h1>↵<p>some seco desctription</p>↵<p>askdsaj;ldsjfd</p>',
            'status'          => '1',
        ];
        $response = '';
        $response = $this->json('POST', '/api/v1/pages', $payload, $this->headers);
        $response->assertStatus(201);
        $response->assertJson([
            'data' => [
                'title'        => $page->title,
                'status_label' => $page->status_label,
                'status'       => ($page->isActive()) ? 'Active' : 'InActive',
                'created_by'   => $this->user->first_name,
                'created_at'   => (\Carbon\Carbon::now())->toDateString(),
            ],
        ]);
    }

    /**
     *  Author: Indra Shastri
     *  Date:03-03-2018
     * A basic test to create a page from api.
     *
     * @return void
     */

    /** @test */
    public function delete_page_in_db_and_get_response()
    {
        $page = create(Page::class);
        $payload = [];
        $response = $this->json('DELETE', '/api/v1/pages/'.$page->id, $payload, $this->headers);
        $response->assertStatus(200)
            ->assertJson([
                'message'=> 'The Page was successfully deleted.',
            ]);
    }
}
