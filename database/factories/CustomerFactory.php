<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition()
    {
        $code = Helper::IDGenerator(new Customer(), 'code', 2, 'CUST');

        return [
            'name' => fake()->name(),
            'address' => $this->faker->address,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'email' => fake()->safeEmail(),
            'code' => $code,
            'user_id' =>  User::role(Role::ROLE_DISTRIBUTOR)->inRandomOrder()->first()->id,
        ];
    }
}
