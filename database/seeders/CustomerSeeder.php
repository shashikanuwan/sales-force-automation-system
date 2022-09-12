<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        collect(range(1, 10))->each(function ($id) {
            Customer::factory()->create(['name' => "Customer_{$id}", 'email' => "customer_{$id}@example.com"]);
        });
    }
}
