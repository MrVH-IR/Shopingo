<?php

namespace Tests\Feature\Admin\Content;

use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PostRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_post_index(): void
    {
        $response = $this->get(route('admin.content.post.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_post_create_page(): void
    {
        $response = $this->get(route('admin.content.post.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_post(): void
    {
        $category = PostCategory::factory()->create();

        $response = $this->post(route('admin.content.post.store'), [
            'title' => 'پست تست',
            'tags' => 'tag1,tag2',
            'status' => 1,
            'category_id' => $category->id,
            'image' => \Illuminate\Http\UploadedFile::fake()->image('post.jpg'),
            'published_at' => Carbon::now()->format('Y-m-d'),
            'commentable' => 1,
            'summary' => 'خلاصه پست تست',
            'body' => 'محتوای پست تست که باید حداقل 5 کاراکتر باشد.',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', ['title' => 'پست تست']);
    }

    #[Test]
    public function admin_can_edit_post(): void
    {
        $post = Post::factory()->create();
        $response = $this->get(route('admin.content.post.edit', $post->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_post(): void
    {
        $post = Post::factory()->create();
        $category = PostCategory::factory()->create();

        $response = $this->put(route('admin.content.post.update', $post->id), [
            'title' => 'پست آپدیت شده',
            'tags' => 'updated,tag',
            'status' => 1,
            'category_id' => $category->id,
            'published_at' => Carbon::now()->format('Y-m-d'),
            'commentable' => 1,
            'summary' => 'خلاصه آپدیت شده',
            'body' => 'محتوای آپدیت شده که باید حداقل 5 کاراکتر باشد.',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', ['title' => 'پست آپدیت شده']);
    }

    #[Test]
    public function admin_can_destroy_post(): void
    {
        $post = Post::factory()->create();
        $response = $this->delete(route('admin.content.post.destroy', $post->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($post);
    }

    #[Test]
    public function admin_can_change_post_status(): void
    {
        $post = Post::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.content.post.status', $post));

        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', ['id' => $post->id, 'status' => 1]);
    }

    #[Test]
    public function admin_can_change_post_commentable(): void
    {
        $post = Post::factory()->create(['commentable' => 0]);

        $response = $this->get(route('admin.content.post.commentable', $post));

        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', ['id' => $post->id, 'commentable' => 1]);
    }
}