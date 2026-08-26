<?php

namespace Tests\Feature\Admin\Content;

use App\Models\Content\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PageRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_page_index(): void
    {
        $response = $this->get(route('admin.content.page.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_page_create_page(): void
    {
        $response = $this->get(route('admin.content.page.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_page(): void
    {
        $response = $this->post(route('admin.content.page.store'), [
            'title' => 'صفحه تست',
            'body' => 'محتوای صفحه تست که باید حداقل 50 کاراکتر باشد برای تست.',
            'status' => 1,
            'tags' => 'تگ تست',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('pages', ['title' => 'صفحه تست']);
    }

    #[Test]
    public function admin_can_edit_page(): void
    {
        $page = Page::factory()->create();
        $response = $this->get(route('admin.content.page.edit', $page->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_page(): void
    {
        $page = Page::factory()->create();

        $response = $this->put(route('admin.content.page.update', $page->id), [
            'title' => 'صفحه آپدیت شده',
            'body' => 'محتوای آپدیت شده که باید حداقل 50 کاراکتر باشد برای تست.',
            'status' => 1,
            'tags' => 'تگ آپدیت',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('pages', ['title' => 'صفحه آپدیت شده']);
    }

    #[Test]
    public function admin_can_destroy_page(): void
    {
        $page = Page::factory()->create();
        $response = $this->delete(route('admin.content.page.destroy', $page->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($page);
    }

    #[Test]
    public function admin_can_change_page_status(): void
    {
        $page = Page::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.content.page.status', $page));

        $response->assertStatus(302);
        $this->assertDatabaseHas('pages', ['id' => $page->id, 'status' => 1]);
    }
}