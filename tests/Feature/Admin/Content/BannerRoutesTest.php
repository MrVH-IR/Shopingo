<?php

namespace Tests\Feature\Admin\Content;

use App\Models\Content\Banner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BannerRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_banner_index(): void
    {
        $response = $this->get(route('admin.content.banner.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_banner_create_page(): void
    {
        $response = $this->get(route('admin.content.banner.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_banner(): void
    {
        $response = $this->post(route('admin.content.banner.store'), [
            'title' => 'بنر تست',
            'link' => 'https://example.com',
            'status' => 1,
            'position' => 1,
            'image' => \Illuminate\Http\UploadedFile::fake()->image('banner.jpg'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('banners', ['title' => 'بنر تست']);
    }

    #[Test]
    public function admin_can_edit_banner(): void
    {
        $banner = Banner::factory()->create();
        $response = $this->get(route('admin.content.banner.edit', $banner->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_banner(): void
    {
        $banner = Banner::factory()->create();

        $response = $this->put(route('admin.content.banner.update', $banner->id), [
            'title' => 'بنر آپدیت شده',
            'link' => 'https://updated.com',
            'status' => 1,
            'position' => 2,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('banners', ['title' => 'بنر آپدیت شده']);
    }

    #[Test]
    public function admin_can_destroy_banner(): void
    {
        $banner = Banner::factory()->create();
        $response = $this->delete(route('admin.content.banner.destroy', $banner->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($banner);
    }

    #[Test]
    public function admin_can_change_banner_status(): void
    {
        $banner = Banner::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.content.banner.status', $banner));

        $response->assertStatus(302);
        $this->assertDatabaseHas('banners', ['id' => $banner->id, 'status' => 1]);
    }
}