<?php

namespace Tests\Feature\Admin\Content;

use App\Models\Content\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MenuRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_menu_index(): void
    {
        $response = $this->get(route('admin.content.menu.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_menu_create_page(): void
    {
        $response = $this->get(route('admin.content.menu.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_menu(): void
    {
        $response = $this->post(route('admin.content.menu.store'), [
            'title' => 'منوی تست',
            'url' => 'https://example.com',
            'status' => 1,
            'parent_id' => 0,
            'order' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('menus', ['title' => 'منوی تست']);
    }

    #[Test]
    public function admin_can_edit_menu(): void
    {
        $menu = Menu::factory()->create();
        $response = $this->get(route('admin.content.menu.edit', $menu->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_menu(): void
    {
        $menu = Menu::factory()->create();

        $response = $this->put(route('admin.content.menu.update', $menu->id), [
            'title' => 'منوی آپدیت شده',
            'url' => 'https://updated.com',
            'status' => 1,
            'parent_id' => 0,
            'order' => 2,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('menus', ['title' => 'منوی آپدیت شده']);
    }

    #[Test]
    public function admin_can_destroy_menu(): void
    {
        $menu = Menu::factory()->create();
        $response = $this->delete(route('admin.content.menu.destroy', $menu->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($menu);
    }

    #[Test]
    public function admin_can_change_menu_status(): void
    {
        $menu = Menu::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.content.menu.status', $menu));

        $response->assertStatus(302);
        $this->assertDatabaseHas('menus', ['id' => $menu->id, 'status' => 1]);
    }
}