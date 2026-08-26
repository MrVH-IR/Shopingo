<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminUserRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_admin_user_index(): void
    {
        $response = $this->get(route('admin.user.admin-user.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_admin_user_create_page(): void
    {
        $response = $this->get(route('admin.user.admin-user.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_admin_user(): void
    {
        $response = $this->post(route('admin.user.admin-user.store'), [
            'first_name' => 'علی',
            'last_name' => 'محمدی',
            'email' => 'admin@test.com',
            'mobile' => '09123456789',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'profile_photo_path' => null,
            'activation' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['email' => 'admin@test.com']);
    }

    #[Test]
    public function admin_can_edit_admin_user(): void
    {
        $user = User::factory()->create(['user_type' => 1]);
        $response = $this->get(route('admin.user.admin-user.edit', $user->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_admin_user(): void
    {
        $user = User::factory()->create(['user_type' => 1]);

        $response = $this->put(route('admin.user.admin-user.update', $user->id), [
            'first_name' => 'رضا',
            'last_name' => 'احمدی',
            'profile_photo_path' => null,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['first_name' => 'رضا', 'last_name' => 'احمدی']);
    }

    #[Test]
    public function admin_can_destroy_admin_user(): void
    {
        $user = User::factory()->create(['user_type' => 1]);
        $response = $this->delete(route('admin.user.admin-user.destroy', $user->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($user);
    }

    #[Test]
    public function admin_can_change_admin_user_activation(): void
    {
        $user = User::factory()->create(['user_type' => 1, 'activation' => 0]);

        $response = $this->get(route('admin.user.admin-user.activation', $user));

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'activation' => 1]);
    }

    #[Test]
    public function admin_can_change_admin_user_status(): void
    {
        $user = User::factory()->create(['user_type' => 1, 'status' => 0]);

        $response = $this->get(route('admin.user.admin-user.status', $user));

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'status' => 1]);
    }
}