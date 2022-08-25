<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::query()->insert([
            ['name' => 'Biscuits'],
            ['name' => 'Chocolates'],
            ['name' => 'Snacks'],
            ['name' => 'Wafers'],
        ]);
    }
}
