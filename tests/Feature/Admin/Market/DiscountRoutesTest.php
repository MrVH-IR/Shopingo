<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Market\Coupon;
use App\Models\Market\CommonDiscount;
use App\Models\Market\AmazingSale;
use App\Models\Market\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DiscountRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_discount_coupon_index(): void
    {
        $response = $this->get(route('admin.market.discount.copan'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_discount_coupon_create_page(): void
    {
        $response = $this->get(route('admin.market.discount.copan.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_coupon(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('admin.market.discount.copan.store'), [
            'code' => 'TEST10',
            'amount' => 10,
            'amount_type' => 0,
            'discount_ceiling' => 50000,
            'type' => 1,
            'status' => 1,
            'start_date' => Carbon::now()->format('Y/m/d H:i:s'),
            'end_date' => Carbon::now()->addDays(30)->format('Y/m/d H:i:s'),
            'user_id' => $user->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('coupons', ['code' => 'TEST10']);
    }

    #[Test]
    public function admin_can_edit_coupon(): void
    {
        $coupon = Coupon::factory()->create();
        $response = $this->get(route('admin.market.discount.coupon.edit', $coupon->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_coupon(): void
    {
        $coupon = Coupon::factory()->create();

        $response = $this->put(route('admin.market.discount.coupon.update', $coupon->id), [
            'code' => 'UPDATED20',
            'amount' => 20,
            'amount_type' => 0,
            'discount_ceiling' => 100000,
            'type' => 1,
            'status' => 1,
            'start_date' => Carbon::now()->format('Y/m/d H:i:s'),
            'end_date' => Carbon::now()->addDays(60)->format('Y/m/d H:i:s'),
            'user_id' => $coupon->user_id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('coupons', ['code' => 'UPDATED20']);
    }

    #[Test]
    public function admin_can_destroy_coupon(): void
    {
        $coupon = Coupon::factory()->create();
        $response = $this->delete(route('admin.market.discount.coupon.destroy', $coupon->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($coupon);
    }

    #[Test]
    public function admin_can_access_common_discount_index(): void
    {
        $response = $this->get(route('admin.market.discount.commonDiscount'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_common_discount_create_page(): void
    {
        $response = $this->get(route('admin.market.discount.commonDiscount.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_common_discount(): void
    {
        $response = $this->post(route('admin.market.discount.commonDiscount.store'), [
            'title' => 'تخفیف عمومی تست',
            'discount' => 15,
            'discount_ceiling' => 100000,
            'discount_floor' => 50000,
            'status' => 1,
            'start_date' => Carbon::now()->format('Y/m/d H:i:s'),
            'end_date' => Carbon::now()->addDays(30)->format('Y/m/d H:i:s'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('common_discounts', ['title' => 'تخفیف عمومی تست']);
    }

    #[Test]
    public function admin_can_edit_common_discount(): void
    {
        $discount = CommonDiscount::factory()->create();
        $response = $this->get(route('admin.market.discount.commonDiscount.edit', $discount->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_common_discount(): void
    {
        $discount = CommonDiscount::factory()->create();

        $response = $this->put(route('admin.market.discount.commonDiscount.update', $discount->id), [
            'title' => 'تخفیف عمومی آپدیت',
            'discount' => 20,
            'discount_ceiling' => 200000,
            'discount_floor' => 100000,
            'status' => 1,
            'start_date' => Carbon::now()->format('Y/m/d H:i:s'),
            'end_date' => Carbon::now()->addDays(60)->format('Y/m/d H:i:s'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('common_discounts', ['title' => 'تخفیف عمومی آپدیت']);
    }

    #[Test]
    public function admin_can_destroy_common_discount(): void
    {
        $discount = CommonDiscount::factory()->create();
        $response = $this->delete(route('admin.market.discount.commonDiscount.destroy', $discount->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($discount);
    }

    #[Test]
    public function admin_can_access_amazing_sale_index(): void
    {
        $response = $this->get(route('admin.market.discount.amazingSale'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_amazing_sale_create_page(): void
    {
        $response = $this->get(route('admin.market.discount.amazingSale.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_amazing_sale(): void
    {
        $product = Product::factory()->create();

        $response = $this->post(route('admin.market.discount.amazingSale.store'), [
            'percentage' => 25,
            'product_id' => $product->id,
            'status' => 1,
            'start_at' => Carbon::now()->format('Y/m/d H:i:s'),
            'end_at' => Carbon::now()->addDays(7)->format('Y/m/d H:i:s'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('amazing_sales', ['percentage' => 25]);
    }

    #[Test]
    public function admin_can_edit_amazing_sale(): void
    {
        $sale = AmazingSale::factory()->create();
        $response = $this->get(route('admin.market.discount.amazingSale.edit', $sale->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_amazing_sale(): void
    {
        $sale = AmazingSale::factory()->create();

        $response = $this->put(route('admin.market.discount.amazingSale.update', $sale->id), [
            'percentage' => 30,
            'product_id' => $sale->product_id,
            'status' => 1,
            'start_at' => Carbon::now()->format('Y/m/d H:i:s'),
            'end_at' => Carbon::now()->addDays(14)->format('Y/m/d H:i:s'),
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('amazing_sales', ['percentage' => 30]);
    }

    #[Test]
    public function admin_can_destroy_amazing_sale(): void
    {
        $sale = AmazingSale::factory()->create();
        $response = $this->delete(route('admin.market.discount.amazingSale.destroy', $sale->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($sale);
    }
}