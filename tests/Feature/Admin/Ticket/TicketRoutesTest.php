<?php

namespace Tests\Feature\Admin\Ticket;

use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_ticket_index(): void
    {
        $response = $this->get(route('admin.ticket.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_new_tickets(): void
    {
        $response = $this->get(route('admin.ticket.newtickets'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_open_tickets(): void
    {
        $response = $this->get(route('admin.ticket.opentickets'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_close_tickets(): void
    {
        $response = $this->get(route('admin.ticket.closetickets'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_ticket_create_page(): void
    {
        $response = $this->get(route('admin.ticket.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_show_ticket(): void
    {
        $category = TicketCategory::factory()->create();
        $priority = TicketPriority::factory()->create();
        $ticket = Ticket::factory()->create([
            'category_id' => $category->id,
            'priority_id' => $priority->id,
            'user_id' => $this->admin->id,
        ]);

        $response = $this->get(route('admin.ticket.show', $ticket));

        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_answer_ticket(): void
    {
        $category = TicketCategory::factory()->create();
        $priority = TicketPriority::factory()->create();
        $ticket = Ticket::factory()->create([
            'category_id' => $category->id,
            'priority_id' => $priority->id,
            'user_id' => $this->admin->id,
        ]);

        $response = $this->post(route('admin.ticket.answer', $ticket), [
            'answer' => 'این پاسخ ادمین به تیکت است.',
        ]);

        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_change_ticket_status(): void
    {
        $category = TicketCategory::factory()->create();
        $priority = TicketPriority::factory()->create();
        $ticket = Ticket::factory()->create([
            'category_id' => $category->id,
            'priority_id' => $priority->id,
            'user_id' => $this->admin->id,
            'status' => 1,
        ]);

        $response = $this->get(route('admin.ticket.change', $ticket));

        $response->assertStatus(302);
        $this->assertDatabaseHas('tickets', ['id' => $ticket->id, 'status' => 0]);
    }
}