<?php

namespace Tests\Feature\Admin;

use App\Models\Market\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BrandRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_brand_index()
    {
        $response = $this->get(route('admin.market.brand.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_brand_create_page()
    {
        $response = $this->get(route('admin.market.brand.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_brand()
    {
        $brand = Brand::factory()->create();
        $response = $this->post(route('admin.market.brand.store'), [$brand]);
        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_edit_brand()
    {
        $brand = Brand::factory()->create();
        $response = $this->put(route('admin.market.brand.update' , $brand->id) , [
            'persian_name'  => 'اسم برند آپدیت شده',
            'original_name' => 'Brand Name Updated'
        ]);

        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_destroy_brand()
    {
        $brand = Brand::factory()->create();
        $response = $this->delete(route('admin.market.brand.destroy' , $brand->id));
        $response->assertStatus(302);
    }
}
