<?php

namespace Tests\Feature\View;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SearchTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void {
        parent::setUp();

        $this->seed();
    }
    /**
     * Test Searchbar
     *
     * @return void
     */
    public function test_search_page_can_be_rendered()
    {

        $response = $this->get('/search?search=shyk');

        $response->assertStatus(200);
    }
}
