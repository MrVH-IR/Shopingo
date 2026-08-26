<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LockScreenRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create(['password' => bcrypt('password')]);
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_lock_screen(): void
    {
        $response = $this->post(route('lock-screen.lock'));

        $response->assertStatus(302);
        $response->assertRedirect(route('lock-screen.show'));
        $this->assertTrue(session('screen_locked'));
    }

    #[Test]
    public function admin_can_view_lock_screen(): void
    {
        session(['screen_locked' => true]);

        $response = $this->get(route('lock-screen.show'));

        $response->assertStatus(200);
    }

    #[Test]
    public function admin_cannot_view_lock_screen_when_not_locked(): void
    {
        $response = $this->get(route('lock-screen.show'));

        $response->assertStatus(403);
    }

    #[Test]
    public function admin_can_unlock_screen(): void
    {
        session(['screen_locked' => true]);

        $response = $this->post(route('lock-screen.unlock'), [
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.home'));
        $this->assertNull(session('screen_locked'));
    }

    #[Test]
    public function admin_cannot_unlock_with_wrong_password(): void
    {
        session(['screen_locked' => true]);

        $response = $this->post(route('lock-screen.unlock'), [
            'password' => 'wrong_password',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('password');
    }
}