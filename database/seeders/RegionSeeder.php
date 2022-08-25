<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run()
    {
        collect(range(1, 5))->each(function ($id) {
            Region::factory()->create(['name' => "Region Name {$id}"]);
        });
    }
}
