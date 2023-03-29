<?php

namespace Database\Seeders;

use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleDistributorCoExecutor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            insert into roles (name, guard_name) values
                ('Distributor', 'web'),
                ('CoExecutor', 'web')
        ");
    }
}
