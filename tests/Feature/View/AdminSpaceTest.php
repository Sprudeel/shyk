<?php

namespace Tests\Feature\View;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminSpaceTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void {
        parent::setUp();

        $this->seed();
    }
    /**
     * Test if Permissions Overview can be rendered
     *
     * @return void
     */
    public function test_permissions_overview_can_be_rendered()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->get('/admin/roles-permissions');

        $response->assertStatus(200);
    }

    /**
     * Test if User Overview can be rendered
     *
     * @return void
     */
    public function test_user_overview_can_be_rendered()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->get('/admin/roles-permissions/users');

        $response->assertStatus(200);
    }

    /**
     * Test if User Edit Form can be rendered
     *
     * @return void
     */
    public function test_user_edit_form_can_be_rendered()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->get('/admin/roles-permissions/users/edit/1');

        $response->assertStatus(200);
    }

    /**
     * Test if User Edit Form can be rendered
     *
     * @return void
     */
    public function test_user_edit_post()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->post('/admin/roles-permissions/users/edit', [
            'id' => 1,
            'username' => 'sprudeel',
            'email' => 'sprudeel@example.com',
            'role_id' => 2,
        ]);

        $response->assertRedirect('/admin/roles-permissions/users');
    }

    /**
     * Test if Role Overview can be rendered
     *
     * @return void
     */
    public function test_role_overview_can_be_rendered()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->get('/admin/roles-permissions/roles');

        $response->assertStatus(200);
    }

    /**
     * Test if Role Create Form can be rendered
     *
     * @return void
     */
    public function test_role_create_form_can_be_rendered()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->get('/admin/roles-permissions/role/create');

        $response->assertStatus(200);
    }

    /**
     * Test if Role Edit Form can be rendered
     *
     * @return void
     */
    public function test_role_edit_form_can_be_rendered()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->get('/admin/roles-permissions/role/edit/1');

        $response->assertStatus(200);
    }


    /**
     * Test if Role Create Post succeeds
     *
     * @return void
     */
    public function test_role_create_post_succeeds()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->post('/admin/roles-permissions/role/create/new', [
            'name' => 'Neue Rolle'
        ]);
        $response = $this->actingAs($user)->post('/admin/roles-permissions/role/create/new', [
            'name' => 'Neue Rolle'
        ]);
        $response = $this->actingAs($user)->post('/admin/roles-permissions/role/create/new', [
            'name' => 'Neue Rolle'
        ]);

        $response->assertRedirect('/admin/roles-permissions/roles');
    }

    /**
     * Test if Role Delete Post succeeds
     *
     * @return void
     */
    public function test_role_delete_post_succeeds()
    {
        $user = User::factory()->create([
            'role_id' => 2,
        ]);

        $response = $this->actingAs($user)->post('/admin/roles-permissions/role/delete/1');

        $response->assertStatus(302);
    }
}
