<?php

namespace Tests\Feature\Admin\Ticket;

use App\Models\Ticket\TicketCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketCategoryRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_ticket_category_index(): void
    {
        $response = $this->get(route('admin.ticket.category.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_ticket_category_create_page(): void
    {
        $response = $this->get(route('admin.ticket.category.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_ticket_category(): void
    {
        $response = $this->post(route('admin.ticket.category.store'), [
            'name' => 'دسته بندی تیکت',
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('ticket_categories', ['name' => 'دسته بندی تیکت']);
    }

    #[Test]
    public function admin_can_edit_ticket_category(): void
    {
        $category = TicketCategory::factory()->create();
        $response = $this->get(route('admin.ticket.category.edit', $category->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_ticket_category(): void
    {
        $category = TicketCategory::factory()->create();

        $response = $this->put(route('admin.ticket.category.update', $category->id), [
            'name' => 'دسته بندی آپدیت',
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('ticket_categories', ['name' => 'دسته بندی آپدیت']);
    }

    #[Test]
    public function admin_can_destroy_ticket_category(): void
    {
        $category = TicketCategory::factory()->create();
        $response = $this->delete(route('admin.ticket.category.destroy', $category->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($category);
    }

    #[Test]
    public function admin_can_change_ticket_category_status(): void
    {
        $category = TicketCategory::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.ticket.category.status', $category));

        $response->assertStatus(302);
        $this->assertDatabaseHas('ticket_categories', ['id' => $category->id, 'status' => 1]);
    }
}