<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Market\CashPayment;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PaymentRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_payment_index(): void
    {
        $response = $this->get(route('admin.market.payment.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_online_payments(): void
    {
        $response = $this->get(route('admin.market.payment.online'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_offline_payments(): void
    {
        $response = $this->get(route('admin.market.payment.offline'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_cash_payments(): void
    {
        $response = $this->get(route('admin.market.payment.cash'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_show_payment(): void
    {
        $payment = Payment::factory()->create();
        $response = $this->get(route('admin.market.payment.show', $payment));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_cancel_payment(): void
    {
        $payment = Payment::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.market.payment.canceled', $payment));

        $response->assertStatus(302);
        $this->assertDatabaseHas('payments', ['id' => $payment->id, 'status' => 2]);
    }

    #[Test]
    public function admin_can_return_payment(): void
    {
        $payment = Payment::factory()->create(['status' => 1]);

        $response = $this->get(route('admin.market.payment.returned', $payment));

        $response->assertStatus(302);
        $this->assertDatabaseHas('payments', ['id' => $payment->id, 'status' => 3]);
    }

    #[Test]
    public function admin_can_confirm_payment(): void
    {
        $payment = Payment::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.market.payment.confirm', $payment));

        $response->assertStatus(302);
        $this->assertDatabaseHas('payments', ['id' => $payment->id, 'status' => 1]);
    }
}