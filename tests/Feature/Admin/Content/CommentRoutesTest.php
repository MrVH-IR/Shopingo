<?php

namespace Tests\Feature\Admin\Content;

use App\Models\Content\Comment;
use App\Models\Content\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CommentRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_content_comment_index(): void
    {
        $response = $this->get(route('admin.content.comment.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_show_content_comment(): void
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->forPost($post)->create();

        $response = $this->get(route('admin.content.comment.show', $comment));

        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_change_content_comment_status(): void
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->forPost($post)->create([
            'status' => 0,
        ]);

        $response = $this->get(route('admin.content.comment.status', $comment));

        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_approve_content_comment(): void
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->forPost($post)->create([
            'approved' => 0,
        ]);

        $response = $this->post(route('admin.content.comment.approved', $comment));

        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_answer_content_comment(): void
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->forPost($post)->create();

        $response = $this->post(route('admin.content.comment.answer', $comment), [
            'body' => 'این پاسخ مدیر به دیدگاه است.',
        ]);

        $response->assertStatus(302);
    }
}