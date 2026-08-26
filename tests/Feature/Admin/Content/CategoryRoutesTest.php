<?php

namespace Tests\Feature\Admin\Content;

use App\Models\Content\PostCategory;
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
    public function admin_can_access_content_category_index(): void
    {
        $response = $this->get(route('admin.content.category.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_content_category_create_page(): void
    {
        $response = $this->get(route('admin.content.category.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_content_category(): void
    {
        $response = $this->post(route('admin.content.category.store'), [
            'name' => 'دسته بندی تست',
            'tags' => 'tag1,tag2',
            'status' => 1,
            'image' => \Illuminate\Http\UploadedFile::fake()->image('category.jpg'),
            'description' => 'توضیحات دسته بندی تست',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('post_categories', ['name' => 'دسته بندی تست']);
    }

    #[Test]
    public function admin_can_edit_content_category(): void
    {
        $category = PostCategory::factory()->create();
        $response = $this->get(route('admin.content.category.edit', $category->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_content_category(): void
    {
        $category = PostCategory::factory()->create();

        $response = $this->put(route('admin.content.category.update', $category->id), [
            'name' => 'دسته بندی آپدیت شده',
            'tags' => 'updated,tag',
            'status' => 1,
            'description' => 'توضیحات آپدیت شده',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('post_categories', ['name' => 'دسته بندی آپدیت شده']);
    }

    #[Test]
    public function admin_can_destroy_content_category(): void
    {
        $category = PostCategory::factory()->create();
        $response = $this->delete(route('admin.content.category.destroy', $category->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($category);
    }

    #[Test]
    public function admin_can_change_content_category_status(): void
    {
        $category = PostCategory::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.content.category.status', $category));

        $response->assertStatus(302);
        $this->assertDatabaseHas('post_categories', ['id' => $category->id, 'status' => 1]);
    }
}