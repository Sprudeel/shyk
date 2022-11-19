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
     * Test if Edit User Post can be made by User
     *
     * @return void
     */
    public function test_userprofile_edit_post_by_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/user/edit', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'name' => 'Tester Test',
            'about' => 'This is an about text!',
            'avatar' => 'defaults/5.png',
        ]);


        $response->assertRedirect('/user/'.$user->username);
    }

     /**
     * Test if Edit User Post can be made by Admin
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
            'email' => $user->email,
            'name' => 'Test Tester',
            'about' => 'This is an about text!',
            'avatar' => 'defaults/5.png',
        ]);

        $response->assertRedirect('/user/'.$user->username);
    }


     /**
     * Test if Edit User Post cannot be made by User on other profile
     *
     * @return void
     */
    public function test_userprofile_edit_post_by_user_on_other_profile()
    {
        $user = User::factory()->create();

        $admin = User::factory()->create([
            'role_id' => 1,
        ]);

        $response = $this->actingAs($admin)->post('/user/edit', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'name' => 'Test Tester',
            'about' => 'This is an about text!',
            'avatar' => 'defaults/5.png',
        ]);

        $response->assertStatus(403);
    }


    /**
     * Test if User Avatar Upload works
     *
     * @return void
     */
    public function test_userprofile_avatar_upload()
    {
        $user = User::factory()->create();

        Storage::fake('local');
        $file = UploadedFile::fake()->create('file.png', 1024);

        $response = $this->actingAs($user)->post('/user/edit', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'name' => 'Tester Test',
            'about' => 'This is an about text!',
            'avatar' => $file,
        ]);


        $response->assertRedirect('/user/'.$user->username);
    }

    /**
     * Test that only images can be uploaded
     *
     * @return void
     */
    public function test_userprofile_avatar_upload_only_images() {
        $user = User::factory()->create();

        Storage::fake('local');
        $file = UploadedFile::fake()->create('file.pdf', 1024);

        $response = $this->actingAs($user)->post('/user/edit', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'name' => 'Tester Test',
            'about' => 'This is an about text!',
            'avatar' => $file,
        ]);


        $response->assertStatus(302);
    }


}
