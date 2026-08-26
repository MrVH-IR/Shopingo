<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Content\Comment;
use App\Models\Market\Product;
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
    public function admin_can_access_comment_index(): void
    {
        $response = $this->get(route('admin.market.comment.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_show_comment(): void
    {
        $product = Product::factory()->create();
        $comment = Comment::factory()->forProduct($product)->create();

        $response = $this->get(route('admin.market.comment.show', $comment));

        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_destroy_comment(): void
    {
        $product = Product::factory()->create();
        $comment = Comment::factory()->forProduct($product)->create();

        $response = $this->delete(route('admin.market.comment.destroy', $comment));

        $response->assertStatus(302);
        $this->assertSoftDeleted($comment);
    }

    #[Test]
    public function admin_can_change_comment_status(): void
    {
        $product = Product::factory()->create();
        $comment = Comment::factory()->forProduct($product)->create([
            'status' => 0,
        ]);

        $response = $this->get(route('admin.market.comment.status', $comment));

        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_approve_comment(): void
    {
        $product = Product::factory()->create();
        $comment = Comment::factory()->forProduct($product)->create([
            'approved' => 0,
        ]);

        $response = $this->post(route('admin.market.comment.approved', $comment));

        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_answer_comment(): void
    {
        $product = Product::factory()->create();
        $comment = Comment::factory()->forProduct($product)->create();

        $response = $this->post(route('admin.market.comment.answer', $comment), [
            'body' => 'این پاسخ مدیر به دیدگاه است.',
        ]);

        $response->assertStatus(302);
    }
}