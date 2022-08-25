<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\Order;
use App\Models\Role;
use App\Models\Sku;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition()
    {
        $number = Helper::IDGenerator(new Order(), 'number', 2, 'ODR');
        return [
            'number' => $number,
            'remark' =>  $this->faker->sentence(),
            'quantity' =>  $this->faker->numberBetween(1, 5000),
            'user_id' =>  User::role(Role::ROLE_DISTRIBUTOR)->inRandomOrder()->first()->id,
            'sku_id' =>  Sku::query()->inRandomOrder()->first()->id,
        ];
    }
}
