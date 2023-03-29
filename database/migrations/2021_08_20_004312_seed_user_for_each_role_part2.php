<?php

use Database\Seeders\UserForEachRolePart2Seeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class SeedUserForEachRolePart2 extends Migration
{

    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => UserForEachRolePart2Seeder::class
        ]);
    }


    public function down()
    {
        //
    }
}
