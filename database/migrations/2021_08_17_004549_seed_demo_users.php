<?php

use Database\Seeders\UserForEachRoleSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedDemoUsers extends Migration
{

    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => UserForEachRoleSeeder::class
        ]);
    }


    public function down()
    {
        //
    }
}
