<?php

namespace Tests\Feature;

use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_sale()
    {
        $seller = Seller::factory()->create();
        $data = [
            'seller_id' => $seller->id,
            'amount' => 1000,
            'sale_date' => now()->format('Y-m-d')
        ];

        $response = $this->postJson('/api/sales', $data);

        $response->assertStatus(201)
        ->assertJsonFragment([
            'amount' => 1000,
            'sale_date' => now()->format('Y-m-d'),
        ])
        ->assertJsonFragment([
            'id' => $seller->id,
            'name' => $seller->name,
            'email' => $seller->email,
        ]);

        $this->assertDatabaseHas('sales', [
            'amount' => 1000,
            'sale_date' => now()->format('Y-m-d'),
            'seller_id' => $seller->id,
        ]);
    }

    public function test_list_sales()
    {
        $seller = Seller::factory()->create();

        Sale::factory()->count(3)->create([
            'seller_id' => $seller->id
        ]);

        $response = $this->getJson('/api/sales');

        $response->assertStatus(200)
                ->assertJsonCount(3);
    }

    public function test_sales_by_seller()
    {
        $mainSeller = Seller::factory()->create();
        $otherSeller = Seller::factory()->create();

        Sale::factory()->create([
            'seller_id' => $mainSeller->id,
            'amount' => 100
        ]);

        Sale::factory()->create([
            'seller_id' => $mainSeller->id,
            'amount' => 200
        ]);

        Sale::factory()->create([
            'seller_id' => $otherSeller->id,
            'amount' => 300
        ]);

        $response = $this->getJson("/api/sellers/{$mainSeller->id}/sales");

        $response->assertStatus(200)
                 ->assertJsonCount(2)
                 ->assertJsonFragment(['amount' => 100])
                 ->assertJsonFragment(['amount' => 200])
                 ->assertJsonMissing(['amount' => 300]);
    }
}
