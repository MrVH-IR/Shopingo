<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Market\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BrandRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_brand_index(): void
    {
        $response = $this->get(route('admin.market.brand.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_brand_create_page(): void
    {
        $response = $this->get(route('admin.market.brand.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_brand(): void
    {
        $response = $this->post(route('admin.market.brand.store'), [
            'persian_name' => 'برند تست',
            'original_name' => 'Test Brand',
            'status' => 1,
            'tags' => ['tag1', 'tag2'],
            'image' => \Illuminate\Http\UploadedFile::fake()->image('brand.jpg'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('brands', ['persian_name' => 'برند تست']);
    }

    #[Test]
    public function admin_can_edit_brand(): void
    {
        $brand = Brand::factory()->create();
        $response = $this->get(route('admin.market.brand.edit', $brand->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_brand(): void
    {
        $brand = Brand::factory()->create();

        $response = $this->put(route('admin.market.brand.update', $brand->id), [
            'persian_name' => 'برند آپدیت شده',
            'original_name' => 'Updated Brand Name',
            'status' => 1,
            'tags' => ['updated', 'tag'],
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('brands', ['persian_name' => 'برند آپدیت شده']);
    }

    #[Test]
    public function admin_can_destroy_brand(): void
    {
        $brand = Brand::factory()->create();
        $response = $this->delete(route('admin.market.brand.destroy', $brand->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($brand);
    }

    #[Test]
    public function admin_can_change_brand_status(): void
    {
        $brand = Brand::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.market.brand.status', $brand));

        $response->assertStatus(302);
        $this->assertDatabaseHas('brands', ['id' => $brand->id, 'status' => 1]);
    }
}