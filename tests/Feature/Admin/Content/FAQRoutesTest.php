<?php

namespace Tests\Feature\Admin\Content;

use App\Models\Content\FAQ;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FAQRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_faq_index(): void
    {
        $response = $this->get(route('admin.content.faq.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_faq_create_page(): void
    {
        $response = $this->get(route('admin.content.faq.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_faq(): void
    {
        $response = $this->post(route('admin.content.faq.store'), [
            'question' => 'سوال متداول تست؟',
            'answer' => 'پاسخ تست برای سوال متداول.',
            'tags' => 'تست',
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('f_a_q_s', ['question' => 'سوال متداول تست؟']);
    }

    #[Test]
    public function admin_can_edit_faq(): void
    {
        $faq = FAQ::factory()->create();
        $response = $this->get(route('admin.content.faq.edit', $faq->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_faq(): void
    {
        $faq = FAQ::factory()->create();

        $response = $this->put(route('admin.content.faq.update', $faq->id), [
            'question' => 'سوال متداول آپدیت شده؟',
            'answer' => 'پاسخ آپدیت شده.',
            'tags' => 'آپدیت',
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('f_a_q_s', ['question' => 'سوال متداول آپدیت شده؟']);
    }

    #[Test]
    public function admin_can_destroy_faq(): void
    {
        $faq = FAQ::factory()->create();
        $response = $this->delete(route('admin.content.faq.destroy', $faq->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($faq);
    }

    #[Test]
    public function admin_can_change_faq_status(): void
    {
        $faq = FAQ::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.content.faq.status', $faq));

        $response->assertStatus(302);
        $this->assertDatabaseHas('f_a_q_s', ['id' => $faq->id, 'status' => 1]);
    }
}