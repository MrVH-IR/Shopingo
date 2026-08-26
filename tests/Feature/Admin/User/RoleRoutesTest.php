<?php

namespace Tests\Feature\Admin\User;

use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RoleRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_role_index(): void
    {
        $response = $this->get(route('admin.user.role.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_role_create_page(): void
    {
        $response = $this->get(route('admin.user.role.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_role(): void
    {
        $permissions = Permission::factory()->count(3)->create();

        $response = $this->post(route('admin.user.role.store'), [
            'name' => 'test-role',
            'description' => 'توضیحات نقش تست',
            'permissions' => $permissions->pluck('id')->toArray(),
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('roles', ['name' => 'test-role']);
    }

    #[Test]
    public function admin_can_edit_role(): void
    {
        $role = Role::factory()->create();
        $response = $this->get(route('admin.user.role.edit', $role->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_role(): void
    {
        $role = Role::factory()->create();
        $permissions = Permission::factory()->count(2)->create();

        $response = $this->put(route('admin.user.role.update', $role->id), [
            'name' => 'updated-role',
            'description' => 'توضیحات آپدیت شده',
            'permissions' => $permissions->pluck('id')->toArray(),
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('roles', ['name' => 'updated-role']);
    }

    #[Test]
    public function admin_can_destroy_role(): void
    {
        $role = Role::factory()->create();
        $response = $this->delete(route('admin.user.role.destroy', $role->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($role);
    }

    #[Test]
    public function admin_can_change_role_status(): void
    {
        $role = Role::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.user.role.status', $role));

        $response->assertStatus(302);
        $this->assertDatabaseHas('roles', ['id' => $role->id, 'status' => 1]);
    }
}