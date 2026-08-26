<?php

namespace Tests\Feature\Admin\Ticket;

use App\Models\Ticket\TicketPriority;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketPriorityRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_ticket_priority_index(): void
    {
        $response = $this->get(route('admin.ticket.priority.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_ticket_priority_create_page(): void
    {
        $response = $this->get(route('admin.ticket.priority.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_ticket_priority(): void
    {
        $response = $this->post(route('admin.ticket.priority.store'), [
            'name' => 'اولویت بالا',
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('ticket_priorities', ['name' => 'اولویت بالا']);
    }

    #[Test]
    public function admin_can_edit_ticket_priority(): void
    {
        $priority = TicketPriority::factory()->create();
        $response = $this->get(route('admin.ticket.priority.edit', $priority->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_ticket_priority(): void
    {
        $priority = TicketPriority::factory()->create();

        $response = $this->put(route('admin.ticket.priority.update', $priority->id), [
            'name' => 'اولویت متوسط',
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('ticket_priorities', ['name' => 'اولویت متوسط']);
    }

    #[Test]
    public function admin_can_destroy_ticket_priority(): void
    {
        $priority = TicketPriority::factory()->create();
        $response = $this->delete(route('admin.ticket.priority.destroy', $priority->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($priority);
    }

    #[Test]
    public function admin_can_change_ticket_priority_status(): void
    {
        $priority = TicketPriority::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.ticket.priority.status', $priority));

        $response->assertStatus(302);
        $this->assertDatabaseHas('ticket_priorities', ['id' => $priority->id, 'status' => 1]);
    }
}