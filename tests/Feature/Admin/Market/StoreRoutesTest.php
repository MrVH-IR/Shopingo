<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Market\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_store_index(): void
    {
        $response = $this->get(route('admin.market.store.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_add_to_store(): void
    {
        $product = Product::factory()->create();
        $response = $this->get(route('admin.market.store.addToStore', $product));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_to_storage(): void
    {
        $product = Product::factory()->create();

        $response = $this->post(route('admin.market.store.store', $product), [
            'receiver' => 'علی محمدی',
            'deliverer' => 'محمدرضا احمدی',
            'marketable_number' => 100,
            'description' => 'ورود کالا به انبار',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'marketable_number' => 100]);
    }

    #[Test]
    public function admin_can_edit_store(): void
    {
        $product = Product::factory()->create();
        $response = $this->get(route('admin.market.store.edit', $product));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_store(): void
    {
        $product = Product::factory()->create(['marketable_number' => 50]);

        $response = $this->put(route('admin.market.store.update', $product), [
            'marketable_number' => 200,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'marketable_number' => 200]);
    }
}