<?php

namespace Tests\Feature\Admin\Market;

use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;
use App\Models\Market\ProductCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PropertyRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
        $this->actingAs($this->admin);
    }

    #[Test]
    public function admin_can_access_property_index(): void
    {
        $response = $this->get(route('admin.market.property.index'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_property_create_page(): void
    {
        $response = $this->get(route('admin.market.property.create'));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_property(): void
    {
        $category = ProductCategory::factory()->create();

        $response = $this->post(route('admin.market.property.store'), [
            'name' => 'رنگ',
            'type' => 'select',
            'unit' => 'بدون واحد',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('category_attributes', ['name' => 'رنگ']);
    }

    #[Test]
    public function admin_can_edit_property(): void
    {
        $property = CategoryAttribute::factory()->create();
        $response = $this->get(route('admin.market.property.edit', $property->id));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_property(): void
    {
        $property = CategoryAttribute::factory()->create();
        $category = ProductCategory::factory()->create();

        $response = $this->put(route('admin.market.property.update', $property->id), [
            'name' => 'اندازه',
            'type' => 'radio',
            'unit' => 'سایز',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('category_attributes', ['name' => 'اندازه']);
    }

    #[Test]
    public function admin_can_destroy_property(): void
    {
        $property = CategoryAttribute::factory()->create();
        $response = $this->delete(route('admin.market.property.destroy', $property->id));
        $response->assertStatus(302);
        $this->assertSoftDeleted($property);
    }

    #[Test]
    public function admin_can_access_property_values(): void
    {
        $property = CategoryAttribute::factory()->create();
        $response = $this->get(route('admin.market.value.index', $property));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_access_property_value_create(): void
    {
        $property = CategoryAttribute::factory()->create();
        $response = $this->get(route('admin.market.value.create', $property));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_store_property_value(): void
    {
        $property = CategoryAttribute::factory()->create();

        $response = $this->post(route('admin.market.value.store', $property), [
            'value' => 'قرمز',
            'type' => 1,
            'price_increase' => 0,
            'product_id' => \App\Models\Market\Product::factory()->create()->id,
        ]);

        $response->assertStatus(302);
    }

    #[Test]
    public function admin_can_edit_property_value(): void
    {
        $property = CategoryAttribute::factory()->create();
        $value = CategoryValue::factory()->create(['category_attribute_id' => $property->id]);

        $response = $this->get(route('admin.market.value.edit', [$property, $value]));
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_can_update_property_value(): void
    {
        $property = CategoryAttribute::factory()->create();
        $value = CategoryValue::factory()->create(['category_attribute_id' => $property->id]);

        $response = $this->put(route('admin.market.value.update', [$property, $value]), [
            'value' => 'آبی',
            'type' => 1,
            'price_increase' => 5000,
            'product_id' => $value->product_id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('category_values', ['value' => 'آبی']);
    }

    #[Test]
    public function admin_can_destroy_property_value(): void
    {
        $property = CategoryAttribute::factory()->create();
        $value = CategoryValue::factory()->create(['category_attribute_id' => $property->id]);

        $response = $this->delete(route('admin.market.value.destroy', [$property, $value]));
        $response->assertStatus(302);
        $this->assertSoftDeleted($value);
    }
}