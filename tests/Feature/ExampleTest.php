<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function not_all_routes_should_work(): void
    {
        $adminRoute = $this->get('/admin');
        $adminRoute->assertStatus(403);

        $adminRoute2 = $this->get('/admin/category');
        $adminRoute2->assertStatus(403);
    }
}
