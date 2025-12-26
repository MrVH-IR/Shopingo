<?php

namespace Feature\Admin;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryRoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->actingAs($this->admin);
    }

    /** @test */
    public function admin_can_access_category_index(): void
    {
        $response = $this->get(route('admin.market.category.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_access_category_create_page(): void
    {
        $response = $this->get(route('admin.market.category.create'));
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_store_category(): void
    {
        $response = $this->post(route('admin.market.category.store'), [
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        $response->assertStatus(302);
    }

    /** @test */
    public function admin_can_edit_category(): void
    {
        $category = \App\Models\Market\ProductCategory::factory()->create();
        $response = $this->get(route('admin.market.category.edit', $category->id));
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_update_category(): void
    {
        $category = \App\Models\Market\ProductCategory::factory()->create();

        $response = $this->put(route('admin.market.category.update', $category->id), [
            'name' => 'Updated Name',
            'slug' => 'updated-slug',
        ]);

        $response->assertStatus(302);
    }

    /** @test */
    public function admin_can_destroy_category(): void
    {
        $category = \App\Models\Market\ProductCategory::factory()->create();

        $response = $this->delete(route('admin.market.category.destroy', $category->id));
        $response->assertStatus(302);
    }
}
