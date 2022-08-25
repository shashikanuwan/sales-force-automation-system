<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        collect(range(1, 2))->each(function ($id) {
            User::factory()->create(['user_name' => "admin_{$id}", 'email' => "admin_{$id}@example.com", 'territory_id' => null])->assignRole(Role::ROLE_ADMIN);
        });

        collect(range(1, 5))->each(function ($id) {
            User::factory()->create(['user_name' => "distributor_{$id}", 'email' => "distributor_{$id}@example.com"])->assignRole(Role::ROLE_DISTRIBUTOR);
        });
    }
}
