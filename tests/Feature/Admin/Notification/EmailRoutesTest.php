<?php

namespace Tests\Feature\Admin\Notification;

use App\Models\Notify\Email;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EmailRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_email_index(): void
    {
        $response = $this->get(route('admin.email.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_email_create_page(): void
    {
        $response = $this->get(route('admin.email.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_email(): void
    {
        $response = $this->post(route('admin.email.store'), [
            'subject' => 'ایمیل تست',
            'body' => 'متن ایمیل تست',
            'status' => 1,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('emails', ['subject' => 'ایمیل تست']);
    }

    #[Test]
    public function admin_can_edit_email(): void
    {
        $email = Email::factory()->create();
        $response = $this->get(route('admin.email.edit', $email->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_email(): void
    {
        $email = Email::factory()->create();

        $response = $this->put(route('admin.email.update', $email->id), [
            'subject' => 'ایمیل آپدیت شده',
            'body' => 'متن آپدیت شده',
            'status' => 1,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('emails', ['subject' => 'ایمیل آپدیت شده']);
    }

    #[Test]
    public function admin_can_destroy_email(): void
    {
        $email = Email::factory()->create();
        $response = $this->delete(route('admin.email.destroy', $email->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($email);
    }

    #[Test]
    public function admin_can_change_email_status(): void
    {
        $email = Email::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.email.status', $email));

        $response->assertStatus(302);
        $this->assertDatabaseHas('emails', ['id' => $email->id, 'status' => 1]);
    }

    #[Test]
    public function admin_can_download_email_file(): void
    {
        $email = Email::factory()->create();
        $response = $this->get(route('admin.email.file.download', $email));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_view_email_file(): void
    {
        $email = Email::factory()->create();
        $response = $this->get(route('admin.email.file.view', $email));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_delete_email_file(): void
    {
        $email = Email::factory()->create();
        $response = $this->delete(route('admin.email.file.delete', $email));
        $response->assertStatus(302);
    }
}