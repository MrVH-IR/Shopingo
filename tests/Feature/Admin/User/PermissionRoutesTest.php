<?php

namespace Tests\Feature\Admin\User;

use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PermissionRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_permission_index(): void
    {
        $user = User::factory()->create();
        $response = $this->get(route('admin.user.permission.index', $user));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_permission_create_page(): void
    {
        $response = $this->get(route('admin.user.permission.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_permission(): void
    {
        $user = User::factory()->create();
        $roles = Role::factory()->count(2)->create();

        $response = $this->post(route('admin.user.permission.store', $user), [
            'role_id' => $roles->pluck('id')->toArray(),
        ]);

        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_edit_permission(): void
    {
        $user = User::factory()->create();
        $permission = Permission::factory()->create();

        $response = $this->get(route('admin.user.permission.edit', $permission->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_permission(): void
    {
        $user = User::factory()->create();
        $permission = Permission::factory()->create();
        $roles = Role::factory()->count(2)->create();

        $response = $this->put(route('admin.user.permission.update', $permission->id), [
            'role_id' => $roles->pluck('id')->toArray(),
        ]);

        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_destroy_permission(): void
    {
        $user = User::factory()->create();
        $permission = Permission::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('admin.user.permission.destroy', $user));

        $response->assertStatus(302);
    }
}