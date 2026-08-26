<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_product_index(): void
    {
        $response = $this->get(route('admin.market.product.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_product_create_page(): void
    {
        $response = $this->get(route('admin.market.product.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_product(): void
    {
        $category = ProductCategory::factory()->create();
        $brand = Brand::factory()->create();

        $response = $this->post(route('admin.market.product.store'), [
            'name' => 'Test Product',
            'description' => 'Test product description',
            'image' => \Illuminate\Http\UploadedFile::fake()->image('product.jpg'),
            'weight' => 100,
            'length' => 10,
            'width' => 10,
            'height' => 5,
            'price' => 50000,
            'status' => 1,
            'marketable' => 1,
            'tags' => 'tag1,tag2',
            'brand_id' => $brand->id,
            'product_categories' => $category->id,
            'published_at' => Carbon::now()->format('Y/m/d H:i:s'),
            'meta_key' => ['color', 'size'],
            'meta_value' => ['red', 'L'],
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    #[Test]
    public function admin_can_edit_product(): void
    {
        $product = Product::factory()->create();
        $response = $this->get(route('admin.market.product.edit', $product->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_product(): void
    {
        $product = Product::factory()->create();
        $category = ProductCategory::factory()->create();
        $brand = Brand::factory()->create();

        $response = $this->put(route('admin.market.product.update', $product->id), [
            'name' => 'Updated Product Name',
            'description' => 'Updated product description',
            'weight' => 200,
            'length' => 15,
            'width' => 15,
            'height' => 8,
            'price' => 75000,
            'status' => 1,
            'marketable' => 1,
            'tags' => 'updated,tag',
            'brand_id' => $brand->id,
            'product_categories' => $category->id,
            'published_at' => Carbon::now()->format('Y/m/d H:i:s'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('products', ['name' => 'Updated Product Name']);
    }

    #[Test]
    public function admin_can_destroy_product(): void
    {
        $product = Product::factory()->create();
        $response = $this->delete(route('admin.market.product.destroy', $product->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($product);
    }

    #[Test]
    public function admin_can_change_product_status(): void
    {
        $product = Product::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.market.product.status', $product));

        $response->assertStatus(302);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'status' => 1]);
    }

    #[Test]
    public function admin_can_access_product_colors(): void
    {
        $product = Product::factory()->create();
        $response = $this->get(route('admin.market.color.index', $product));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_product_gallery(): void
    {
        $product = Product::factory()->create();
        $response = $this->get(route('admin.market.gallery.index', $product));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_product_guarantee(): void
    {
        $product = Product::factory()->create();
        $response = $this->get(route('admin.market.guarantee.index', $product));
        $response->assertStatus(200);
    }
}