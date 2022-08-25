<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\Region;
use App\Models\Territory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerritoryFactory extends Factory
{
    public function definition()
    {
        $code = Helper::IDGenerator(new Territory(), 'code', 2, 'TER');
        return [
            'code' =>  $code,
            'name' =>  $this->faker->name(),
            'region_id' =>  Region::query()->inRandomOrder()->first()->id,
        ];
    }
}
