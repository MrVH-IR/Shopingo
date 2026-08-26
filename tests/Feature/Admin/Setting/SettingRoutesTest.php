<?php

namespace Tests\Feature\Admin\Setting;

use App\Models\Setting\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SettingRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_setting_index(): void
    {
        $response = $this->get(route('admin.setting.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_setting_edit_page(): void
    {
        $setting = Setting::factory()->create();
        $response = $this->get(route('admin.setting.edit', $setting->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_setting(): void
    {
        $setting = Setting::factory()->create();

        $response = $this->put(route('admin.setting.update', $setting->id), [
            'title' => 'عنوان سایت تست',
            'description' => 'توضیحات سایت برای تست',
            'keywords' => 'کلمات کلیدی سایت تست',
            'logo' => \Illuminate\Http\UploadedFile::fake()->image('logo.jpg'),
            'favicon' => \Illuminate\Http\UploadedFile::fake()->image('favicon.ico'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('settings', ['title' => 'عنوان سایت تست']);
    }

    #[Test]
    public function admin_can_optimize_app(): void
    {
        $response = $this->post(route('admin.setting.optimization'));
        $response->assertStatus(302);
    }
}