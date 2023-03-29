<?php

use Database\Seeders\RoleSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedRoles extends Migration
{

    public function up() : void
    {
        Artisan::call('db:seed', [
            '--class' => RoleSeeder::class
        ]);
    }


    public function down() : void
    {
        //
    }
}
