<?php

namespace Database\Seeders;

use App\Models\Sku;
use Illuminate\Database\Seeder;

class SkuSeeder extends Seeder
{
    public function run()
    {
        Sku::factory(20)->create();
    }
}
