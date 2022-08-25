<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SkuFactory extends Factory
{
    public function definition()
    {
        return [
            'code' =>  Str::random(4),
            'product_id' =>  Product::query()->inRandomOrder()->first()->id,
        ];
    }
}
