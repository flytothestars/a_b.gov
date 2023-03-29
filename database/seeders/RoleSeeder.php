<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{

    public function run() : void
    {
        $roles = [
            ['id' => 1, 'name' => 'Administrator', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'Manager', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'Client', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'Distributor', 'guard_name' => 'web'],
            ['id' => 5, 'name' => 'CoExecutor', 'guard_name' => 'web'],
            ['id' => 6, 'name' => 'Head', 'guard_name' => 'web'],
            ['id' => 7, 'name' => 'UpiCurator', 'guard_name' => 'web'],
            ['id' => 8, 'name' => 'DistrictCurator', 'guard_name' => 'web'],
            ['id' => 9, 'name' => 'DivisionCurator', 'guard_name' => 'web'],
            ['id' => 10, 'name' => 'MIOIntegration', 'guard_name' => 'web'],
            ['id' => 11, 'name' => 'UPIHead', 'guard_name' => 'web'],
            ['id' => 12, 'name' => 'MSBIntegration', 'guard_name' => 'web'],
            ['id' => 13, 'name' => 'PressSecretary', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::query()->updateOrCreate(['id' => $role['id']], $role);
        }
    }
}
