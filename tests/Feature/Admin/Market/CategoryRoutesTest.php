<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Market\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CategoryRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_category_index(): void
    {
        $response = $this->get(route('admin.market.category.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_category_create_page(): void
    {
        $response = $this->get(route('admin.market.category.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_category(): void
    {
        $parentCategory = ProductCategory::factory()->create();

        $response = $this->post(route('admin.market.category.store'), [
            'name' => 'Test Category',
            'tags' => 'tag1,tag2',
            'status' => 1,
            'description' => 'Test category description',
            'show_in_menu' => 1,
            'parent_id' => $parentCategory->id,
            'image' => \Illuminate\Http\UploadedFile::fake()->image('category.jpg'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('product_categories', ['name' => 'Test Category']);
    }

    #[Test]
    public function admin_can_edit_category(): void
    {
        $category = ProductCategory::factory()->create([
            'image' => [
                'indexArray' => [
                    'img1' => 'images/a.jpg',
                    'img2' => 'images/b.jpg',
                ],
                'currentImage' => 'img1',
                'directory' => 'images/product_categories'
            ],
        ]);
        $response = $this->get(route('admin.market.category.edit', $category->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_category(): void
    {
        $category = ProductCategory::factory()->create();

        $response = $this->put(route('admin.market.category.update', $category->id), [
            'name' => 'Updated Category Name',
            'tags' => 'updated,tag',
            'status' => 1,
            'description' => 'Updated description for category',
            'show_in_menu' => 1,
            'parent_id' => null,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('product_categories', ['name' => 'Updated Category Name']);
    }

    #[Test]
    public function admin_can_destroy_category(): void
    {
        $category = ProductCategory::factory()->create();

        $response = $this->delete(route('admin.market.category.destroy', $category->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($category);
    }
}