<?php

namespace Tests\Feature\Admin\Notification;

use App\Models\Notify\SMS;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SMSRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_sms_index(): void
    {
        $response = $this->get(route('admin.sms.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_sms_create_page(): void
    {
        $response = $this->get(route('admin.sms.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_sms(): void
    {
        $response = $this->post(route('admin.sms.store'), [
            'title' => 'پیامک تست',
            'body' => 'متن پیامک تست',
            'status' => 1,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('s_m_s', ['title' => 'پیامک تست']);
    }

    #[Test]
    public function admin_can_edit_sms(): void
    {
        $sms = SMS::factory()->create();
        $response = $this->get(route('admin.sms.edit', $sms->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_sms(): void
    {
        $sms = SMS::factory()->create();

        $response = $this->put(route('admin.sms.update', $sms->id), [
            'title' => 'پیامک آپدیت شده',
            'body' => 'متن آپدیت شده',
            'status' => 1,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('s_m_s', ['title' => 'پیامک آپدیت شده']);
    }

    #[Test]
    public function admin_can_destroy_sms(): void
    {
        $sms = SMS::factory()->create();
        $response = $this->delete(route('admin.sms.destroy', $sms->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($sms);
    }

    #[Test]
    public function admin_can_change_sms_status(): void
    {
        $sms = SMS::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.sms.status', $sms));

        $response->assertStatus(302);
        $this->assertDatabaseHas('s_m_s', ['id' => $sms->id, 'status' => 1]);
    }
}