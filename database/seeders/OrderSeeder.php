<?php

namespace Database\Seeders;

use App\Models\DistributorOrderProduct;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        collect(range(1, 15))->each(function ($id) {
            Order::factory()
                ->has(DistributorOrderProduct::factory()->count(3))
                ->create();
        });
    }
}
