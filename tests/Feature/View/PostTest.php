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

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void {
        parent::setUp();

        $this->seed();
    }
    /**
     * Test post.create view
     *
     * @return void
     */
    public function test_post_create_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/post/create');

        $response->assertStatus(200);
    }
    /**
     * Test post.store
     *
     * @return void
     */
    public function test_post_can_be_stored()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/post/store', [
            'title' => 'Test Post',
            'topic' => 'shyk',
            'status' => 'public',
            'category' => 'summaries',
            'content' => 'This is a test post',
            'author' => $user->id,
        ]);

        $response->assertRedirect('/post/test-post');
    }

    /**
     * Test post.like
     *
     * @return void
     */
    public function test_post_can_be_liked()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/post/store', [
            'title' => 'Test Like Post',
            'topic' => 'shyk',
            'status' => 'public',
            'category' => 'summaries',
            'content' => 'This is a test post',
            'author' => $user->id,
        ]);

        $response = $this->actingAs($user)->post('/post/like/test-like-post');

        $response->assertStatus(200);
    }

    /**
     * Test post.edit
     *
     * @return void
     */
    public function test_post_can_be_edited()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/post/store', [
            'title' => 'Test Edit Post',
            'topic' => 'shyk',
            'status' => 'public',
            'category' => 'summaries',
            'content' => 'This is a test post',
            'author' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/post/edit/test-edit-post');

        $response->assertStatus(200);
    }

    /**
     * Test post.update
     *
     * @return void
    */
    public function test_post_can_be_updated()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->post('/post/edit', [
            'id' => 1,
            'title' => 'Test Edited Post',
            'topic' => 'shyk',
            'status' => 'public',
            'category' => 'summaries',
            'content' => 'This is a test post, but EDITED!',
        ]);

        $response->assertRedirect('/post/test-edited-post');
    }

    /**
     * Test post.report
     *
     * @return void
     */
    public function test_post_can_be_reported()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/post/store', [
            'title' => 'Test Post',
            'topic' => 'shyk',
            'status' => 'public',
            'category' => 'summaries',
            'content' => 'This is a test post',
            'author' => $user->id,
        ]);

        $response = $this->actingAs($user)->post('/post/report', [
            'reported_post' => '1',
            'reported_post_title' => 'test-post',
            'reason' => 'Eine Begründung',
        ]);

        $response->assertStatus(302);
    }

    /**
     * Test post.verify as admin
     *
     * @return void
     */
    public function test_post_can_be_verified_by_admin()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);


        $this->actingAs($user)->post('/post/store', [
            'title' => 'Test Post',
            'topic' => 'shyk',
            'status' => 'public',
            'category' => 'summaries',
            'content' => 'This is a test post',
            'author' => $user->id,
        ]);

        $response = $this->actingAs($user)->post('/post/verify/test-post');

        $response->assertStatus(200);
    }

    /**
     * Test post.verify as user
     *
     * @return void
     */
    public function test_post_cannot_be_verified_by_user()
    {
        $user = User::factory()->create([
            'role_id' => 1,
        ]);


        $this->actingAs($user)->post('/post/store', [
            'title' => 'Test Post',
            'topic' => 'shyk',
            'status' => 'public',
            'category' => 'summaries',
            'content' => 'This is a test post',
            'author' => $user->id,
        ]);

        $response = $this->actingAs($user)->post('/post/verify/test-post');

        $response->assertStatus(403);
    }

    /**
     * Test post.delete as user
     *
     * @return void
     */
    public function test_post_can_be_deleted()
    {
        $user = User::factory()->create();


        $this->actingAs($user)->post('/post/store', [
            'title' => 'Test Post',
            'topic' => 'shyk',
            'status' => 'public',
            'category' => 'summaries',
            'content' => 'This is a test post',
            'author' => $user->id,
        ]);

        $response = $this->actingAs($user)->post('/post/delete/test-post');

        $response->assertStatus(302);
    }
}
