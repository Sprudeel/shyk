<?php

namespace Tests\Feature\View;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void {
        parent::setUp();

        $this->seed();
    }

    /**
     * Test comment.store
     *
     * @return void
     */
    public function test_comment_can_be_stored()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/comment/store', [
            'parent_id' => 1,
            'content' => 'Dies ist ein Test Kommentar.',
        ]);

        $response->assertStatus(302);
    }

    /**
     * Test comment.update
     *
     * @return void
     */
    public function test_comment_can_be_updated()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->post('/comment/edit', [
            'id' => 1,
            'content' => 'Dies ist ein Test Kommentar bearbeitet.',
        ]);

        $response->assertStatus(302);
    }

    /**
     * Test comment.delete
     *
     * @return void
     */
    public function test_comment_can_be_deleted()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->post('/comment/store', [
            'parent_id' => 1,
            'content' => 'Dies ist ein Test Kommentar der gelöscht wird.',
        ]);

        $response = $this->actingAs($user)->post('/comment/delete/1');

        $response->assertStatus(302);
    }


    /**
     * Test subcomment.store
     *
     * @return void
     */
    public function test_subcomment_can_be_stored()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/comment/store', [
            'post_id' => 1,
            'parent_id' => 1,
            'content' => 'Dies ist ein Test Kommentar.',
        ]);

        $response->assertStatus(302);
    }

    /**
     * Test subcomment.update
     *
     * @return void
     */
    public function test_subcomment_can_be_updated()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->post('/subcomment/edit', [
            'id' => 1,
            'content' => 'Dies ist ein Test Kommentar bearbeitet.',
        ]);

        $response->assertStatus(302);
    }

    /**
     * Test subcomment.delete
     *
     * @return void
     */
    public function test_subcomment_can_be_deleted()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->post('/subcomment/store', [
            'parent_id' => 1,
            'content' => 'Dies ist ein Test Kommentar der gelöscht wird.',
        ]);

        $response = $this->actingAs($user)->post('/subcomment/delete/1');

        $response->assertStatus(302);
    }
}
