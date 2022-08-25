<?php

namespace Database\Seeders;

use App\Models\Territory;
use Illuminate\Database\Seeder;

class TerritorySeeder extends Seeder
{
    public function run()
    {
        collect(range(1, 10))->each(function ($id) {
            Territory::factory()->create(['name' => "Territory Name {$id}"]);
        });
    }
}
