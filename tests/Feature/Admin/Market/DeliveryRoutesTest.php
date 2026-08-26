<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Market\Delivery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeliveryRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_delivery_index(): void
    {
        $response = $this->get(route('admin.market.delivery.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_delivery_create_page(): void
    {
        $response = $this->get(route('admin.market.delivery.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_delivery(): void
    {
        $response = $this->post(route('admin.market.delivery.store'), [
            'name' => 'پست پیشتاز',
            'amount' => 50000,
            'delivery_time' => 3,
            'delivery_time_unit' => 'روز کاری',
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('deliveries', ['name' => 'پست پیشتاز']);
    }

    #[Test]
    public function admin_can_edit_delivery(): void
    {
        $delivery = Delivery::factory()->create();
        $response = $this->get(route('admin.market.delivery.edit', $delivery->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_delivery(): void
    {
        $delivery = Delivery::factory()->create();

        $response = $this->put(route('admin.market.delivery.update', $delivery->id), [
            'name' => 'پست سفارشی',
            'amount' => 75000,
            'delivery_time' => 5,
            'delivery_time_unit' => 'روز کاری',
            'status' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('deliveries', ['name' => 'پست سفارشی']);
    }

    #[Test]
    public function admin_can_destroy_delivery(): void
    {
        $delivery = Delivery::factory()->create();
        $response = $this->delete(route('admin.market.delivery.destroy', $delivery->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($delivery);
    }

    #[Test]
    public function admin_can_change_delivery_status(): void
    {
        $delivery = Delivery::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.market.delivery.status', $delivery));

        $response->assertStatus(302);
        $this->assertDatabaseHas('deliveries', ['id' => $delivery->id, 'status' => 1]);
    }
}