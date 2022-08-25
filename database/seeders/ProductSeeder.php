<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        collect(range(1, 5))->each(function ($id) {
            Product::factory()->create(['name' => "Product Name {$id}"]);
        });
    }
}
