<?php

namespace Tests\Feature;

use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SellerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_create_seller()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ];

        $response = $this->postJson('/api/v1/sellers', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['email' => 'john@example.com']);

        $this->assertDatabaseHas('sellers', ['email' => 'john@example.com']);
    }

    public function test_list_sellers()
    {
        Seller::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/sellers');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }
}
