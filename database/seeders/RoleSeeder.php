<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::query()->insert([
            ['name' => \App\Models\Role::ROLE_ADMIN, 'guard_name' => 'web'],
            ['name' => \App\Models\Role::ROLE_DISTRIBUTOR, 'guard_name' => 'web'],
        ]);
    }
}
