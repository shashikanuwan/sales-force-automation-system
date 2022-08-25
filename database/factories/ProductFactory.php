<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' =>  $this->faker->name(),
            'mrp' =>  $this->faker->randomFloat(2, 50, 500), //Maximum Retail Price
            'weight' =>  $this->faker->randomFloat(null, 0.5, 1000), //Volume
            'symbol' =>  $this->faker->randomElement(array('g', 'Kg', 'l', 'ml')),
            'quantity' =>  $this->faker->numberBetween(0, 5000),
            'distributor_price' =>  $this->faker->randomFloat(2, 50, 5000),
            'category_id' =>  Category::query()->inRandomOrder()->first()->id,
        ];
    }
}
