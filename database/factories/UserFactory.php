<?php

namespace Database\Factories;

use App\Models\Territory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'nic' => $this->faker->unique()->randomNumber(),
            'address' => $this->faker->address,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'gender' => $this->faker->randomElement(array('Male', 'Female')),
            'user_name' => Str::slug($this->faker->unique()->name(), '_'),
            'territory_id' =>  Territory::query()->inRandomOrder()->first()->id,
            'password' => 'password', // $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
