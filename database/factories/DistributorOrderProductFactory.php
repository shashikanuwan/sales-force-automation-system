<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistributorOrderProductFactory extends Factory
{
    public function definition()
    {
        return [
            'quantity' =>  $this->faker->numberBetween(1, 500),
            'product_id' =>  Product::query()->inRandomOrder()->first()->id,
            'order_id' =>  Order::query()->inRandomOrder()->first()->id,
        ];
    }
}
