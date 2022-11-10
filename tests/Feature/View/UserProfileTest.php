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

class UserProfileTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void {
        parent::setUp();

        $this->seed();
    }
    /**
     * Test if User Profile can be rendered
     *
     * @return void
     */
    public function test_userprofile_can_be_rendered()
    {
        $response = $this->get('/user/sprudeel');

        $response->assertStatus(200);
    }
    /**
     * Test if Edit User Profile View can be viewed by User
     *
     * @return void
     */
    public function test_userprofile_edit_can_be_rendered_by_user() {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/user/edit/'.$user->username);

        $response->assertStatus(200);
    }

    /**
     * Test if Edit User Profile View can be viewed by an Admin
     *
     * @return void
     */
    public function test_userprofile_edit_can_be_rendered_by_admin() {
        $user = User::factory()->create();

        $admin = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($admin)->get('/user/edit/'.$user->username);

        $response->assertStatus(200);
    }

     /**
     * Test if Edit User Post can be made viewed by User
     *
     * @return void
     */
    public function test_userprofile_edit_post_by_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/user/edit', [
            'id' => $user->id,
            'username' => $user->username,
            'name' => 'Test Tester',
            'about' => 'This is an about text!',
            'avatar' => 'defaults/5.png',
        ]);

        $response->assertRedirect('/user/'.$user->username);
    }

     /**
     * Test if Edit User Post can be made viewed by Admin
     *
     * @return void
     */
    public function test_userprofile_edit_post_by_admin()
    {
        $user = User::factory()->create();

        $admin = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($admin)->post('/user/edit', [
            'id' => $user->id,
            'username' => $user->username,
            'name' => 'Test Tester',
            'about' => 'This is an about text!',
            'avatar' => 'defaults/5.png',
        ]);

        $response->assertRedirect('/user/'.$user->username);
    }


}