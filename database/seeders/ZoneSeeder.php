<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    public function run()
    {
        collect(range(1, 2))->each(function ($id) {
            Zone::factory()->create(['name' => "Zone Name {$id}", 'description' => "Zone Description {$id}"]);
        });
    }
}
