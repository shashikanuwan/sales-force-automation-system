<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneFactory extends Factory
{
    public function definition()
    {
        $code = Helper::IDGenerator(new Zone(), 'code', 2, 'ZON');
        return [
            'code' =>  $code,
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence,
        ];
    }
}
