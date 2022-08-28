<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        collect(range(1, 555))->each(function ($id) {
            Order::factory()->create(['remark' => "Order remark {$id}"]);
        });
    }
}
