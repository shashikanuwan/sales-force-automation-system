<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\Region;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    public function definition()
    {
        $code = Helper::IDGenerator(new Region(), 'code', 2, 'REG');
        return [
            'code' =>  $code,
            'name' =>  $this->faker->name(),
            'zone_id' =>  Zone::query()->inRandomOrder()->first()->id,
        ];
    }
}
