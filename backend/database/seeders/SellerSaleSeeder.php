<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\Sale;

class SellerSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seller::factory(10)->create()->each(function ($seller) {
            Sale::factory(20)->create([
                'seller_id' => $seller->id,
            ]);
        });
    }
}
