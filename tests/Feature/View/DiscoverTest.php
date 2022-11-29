<?php

namespace Tests\Feature\View;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DiscoverTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void {
        parent::setUp();

        $this->seed();
    }

    /**
     * Test that Discover page can be rendered without data
     *
     * @return void
     */
    public function test_discover_page_loads_normal()
    {
        $response = $this->get('/discover');

        $response->assertStatus(200);
    }

    /**
     * Test that Discover page can be rendered with topic
     *
     * @return void
     */
    public function test_discover_page_loads_with_topic()
    {
        $response = $this->get('/discover/shyk');

        $response->assertStatus(200);
    }

    /**
     * Test that Discover page can be rendered with category
     *
     * @return void
     */
    public function test_discover_page_loads_with_category()
    {
        $response = $this->get('/discover?category=summaries');

        $response->assertStatus(200);
    }

    /**
     * Test that Discover page can be rendered with category & topic
     *
     * @return void
     */
    public function test_discover_page_loads_with_category_and_topic()
    {
        $response = $this->get('/discover/shyk?category=summaries');

        $response->assertStatus(200);
    }

    /**
     * Test that Discover page can be rendered with own posts
     *
     * @return void
     */
    public function test_discover_page_loads_own_posts()
    {
        $response = $this->get('/discover/my');

        $response->assertStatus(200);
    }
}
