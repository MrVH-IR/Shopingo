<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CustomerRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_customer_index(): void
    {
        $response = $this->get(route('admin.user.customer.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_customer_create_page(): void
    {
        $response = $this->get(route('admin.user.customer.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_customer(): void
    {
        $response = $this->post(route('admin.user.customer.store'), [
            'first_name' => 'علی',
            'last_name' => 'محمدی',
            'email' => 'customer@test.com',
            'mobile' => '09123456789',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'profile_photo_path' => null,
            'activation' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['email' => 'customer@test.com']);
    }

    #[Test]
    public function admin_can_edit_customer(): void
    {
        $customer = User::factory()->create(['user_type' => 2]);
        $response = $this->get(route('admin.user.customer.edit', $customer->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_customer(): void
    {
        $customer = User::factory()->create(['user_type' => 2]);

        $response = $this->put(route('admin.user.customer.update', $customer->id), [
            'first_name' => 'رضا',
            'last_name' => 'احمدی',
            'profile_photo_path' => null,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['first_name' => 'رضا', 'last_name' => 'احمدی']);
    }

    #[Test]
    public function admin_can_destroy_customer(): void
    {
        $customer = User::factory()->create(['user_type' => 2]);
        $response = $this->delete(route('admin.user.customer.destroy', $customer->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($customer);
    }

    #[Test]
    public function admin_can_change_customer_status(): void
    {
        $customer = User::factory()->create(['user_type' => 2, 'status' => 0]);

        $response = $this->get(route('admin.user.customer.status', $customer));

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['id' => $customer->id, 'status' => 1]);
    }

    #[Test]
    public function admin_can_change_customer_activation(): void
    {
        $customer = User::factory()->create(['user_type' => 2, 'activation' => 0]);

        $response = $this->get(route('admin.user.customer.activation', $customer));

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['id' => $customer->id, 'activation' => 1]);
    }
}