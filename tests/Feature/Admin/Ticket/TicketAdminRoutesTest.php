<?php

namespace Tests\Feature\Admin\Ticket;

use App\Models\Ticket\TicketAdmin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketAdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_ticket_admin_index(): void
    {
        $response = $this->get(route('admin.ticket.admin.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_set_ticket_admin(): void
    {
        $adminUser = User::factory()->admin()->create();

        $response = $this->get(route('admin.ticket.admin.set', $adminUser));

        $response->assertStatus(302);
        $this->assertDatabaseHas('ticket_admins', ['user_id' => $adminUser->id]);
    }

    #[Test]
    public function admin_can_unset_ticket_admin(): void
    {
        $adminUser = User::factory()->admin()->create();
        TicketAdmin::create(['user_id' => $adminUser->id]);

        $response = $this->get(route('admin.ticket.admin.set', $adminUser));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('ticket_admins', ['user_id' => $adminUser->id]);
    }
}