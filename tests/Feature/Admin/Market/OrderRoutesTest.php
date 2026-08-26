<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Market\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrderRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_order_all(): void
    {
        $response = $this->get(route('admin.market.order.all'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_new_orders(): void
    {
        $response = $this->get(route('admin.market.order.newOrders'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_sending_orders(): void
    {
        $response = $this->get(route('admin.market.order.sending'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_unpaid_orders(): void
    {
        $response = $this->get(route('admin.market.order.unpaid'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_canceled_orders(): void
    {
        $response = $this->get(route('admin.market.order.canceled'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_returned_orders(): void
    {
        $response = $this->get(route('admin.market.order.returned'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_show_order(): void
    {
        $order = Order::factory()->create();
        $response = $this->get(route('admin.market.order.show', $order));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_change_send_status(): void
    {
        $order = Order::factory()->create(['delivery_status' => 0]);

        $response = $this->get(route('admin.market.order.changeStatus', $order));

        $response->assertStatus(302);
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'delivery_status' => 1]);
    }

    #[Test]
    public function admin_can_show_order_detail(): void
    {
        $order = Order::factory()->create();
        $response = $this->get(route('admin.market.order.showDetail', $order));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_change_order_status(): void
    {
        $order = Order::factory()->create(['order_status' => 1]);

        $response = $this->get(route('admin.market.order.orderStatus', $order));

        $response->assertStatus(302);
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'order_status' => 2]);
    }

    #[Test]
    public function admin_can_cancel_order(): void
    {
        $order = Order::factory()->create(['order_status' => 1]);

        $response = $this->get(route('admin.market.order.cancelOrder', $order));

        $response->assertStatus(302);
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'order_status' => 4]);
    }
}